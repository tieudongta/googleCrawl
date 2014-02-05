<?php
    define('SEARCH_START', "http://www.google.com/search?q=");
    define('SEARCH_END', "&start=0&ql=jp");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Hàm tìm link và nội dung link đưa kết quả vào mảng
function handleKeyword($keyword){
    $string = trim($keyword);
            if(preg_match("/ /", $string)){
                $string = str_replace(" ", "+", $string);               
            }
    return $string;        
}

    function getMetaDescription($url){
        $html = get_data($url);
        
        $regex1 = '#<meta\s?.?name="description"\s?.?content="([^"]+)"#';
        $regex2 = '#<meta\s?.?content="([^"]+)"\s?.?name="description"#';
        preg_match($regex1, $html, $matches1);
        preg_match($regex2, $html, $matches2);
        if($matches1){
            return $matches1[1];
        }elseif($matches2){
            return $matches2[1];
        }else{
            return 'Not available';
        }
    }
/*      
 * 
 */
        function findTagA1($url){
        $html=  get_data($url);
        $regex ='#<a[^>]*>(.*?)</a>#';
        preg_match_all($regex, $html, $matches);
        foreach($matches[0]as $k => $match){
            preg_match('#href="([^"]+)"#',$match,$m1);  
            if(!$m1){
                unset($matches[0][$k]);
            }
        }
        $i=0;
        $result = array();
        foreach($matches[0] as $k=>$match){
            
            preg_match('#href="([^"]+)"#',$match,$m1);        
            preg_match('#<img#',$match,$m4);
            preg_match('#title="([^"]+)"#',$match,$m5);
            preg_match('#alt="([^"]+)"#',$match,$m3);
            preg_match('#>(.*)<#',$match,$m2);
           $result[$i]['url']=$m1[1];
            if($m4){
                $result[$i]['type']='Img';
                if($m5){
                    $result[$i]['title']=$m5[1];
                }elseif($m3){
                    $result[$i]['title']=$m3[1];
                }else{
                    $result[$i]['title']='Not available';
                }
            }else{
                $result[$i]['type']='Text';
                if($m2){
                    if(preg_match('#[^/;:"=><-]{30,100}#',$m2[1],$m6)){
                       $result[$i]['title']=$m6[0];
                    }else{
                    $result[$i]['title']=$m2[1];}
                }elseif($m5){
                    preg_match('#title="([^"]+)"#',$match,$m5);
                }else{
                    $result[$i]['title']='Not available';
                }
            }
          $i++;
        }
        return $result;
    }
    function getLinkList1($keyword,$keyword_id){
        $url = "http://www.google.com/search?q=".$keyword;
        $html = get_data($url);
        $regex ="#<h3\sclass=\"r\"><a.*?href=\"([^\"]+)\".*?>([^<]+)</a>#m";
        preg_match_all($regex, $html, $matches);
        //xu ly chuoi thua trong link
        
        foreach($matches[1] as $m1){
            $r ='#(?:/url\?q=)([^&]+)#';
            $m2 = array();
            $flag = preg_match($r, $m1, $m2);
            
           if($flag){
                $r1 = $m2[1];
                
                array_shift($matches[1]);
                array_push($matches[1],$r1);
           }
           
        }
        
        $results=array();
        for($i=0;$i<count($matches[0]);$i++){
            $results[$i]['url']=$matches[1][$i];
            $results[$i]['meta']=  getMetaDescription($matches[1][$i]);
            $results[$i]['title']=$matches[2][$i];
            $results[$i]['keyword_id']=$keyword_id;
        }
        array_shift($results);
        

        return $results;
    }
   function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
        
//hàm tìm nội dung giữa 2 móc trong một chuỗi

//tìm lối đi vòng để đọc các trang web chặn url access
function get_url_contents($url) {
    $crl = curl_init();
    $timeout = 5;
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

//kiểm tra chuỗi để phân loại type:
            function anchor_categorize($string) {
                $type = '';
                $text = '';
                //$url = '';
                
                $regUrl ="#href=\"((.*?))\"#";
                preg_match($regUrl, $string,$arrUrl);
                $url = $arrUrl[1];
                
                $needle = "/<img/";
                $end = '" ';
                if (preg_match($needle, $string)) {
                    
                    $type = "Img";
                    $needle1 = '#alt="(.*?)"#';
                    $needle2 = '#title="(.*?)"#';
                    $textStart1 = 'alt="';
                    $textStart2 = 'title="';

                    if (preg_match($needle2, $string)) {
                        
                    
                        preg_match($needle2, $string,$arrText);
                        
                        $text = $arrText[1];
                        
                    }  else {
                        $text = "NA";
                    }
                } else {
                    $type = "Text";
                    $start = ">";
                    $text = getContentTillEnd($string, $start);
                }
                

                if ($url == null) {
                    $url = "Not available";
                }
                if ($text == null) {
                    $text = "Not available";
                }

                $result = array('text' => $text, 'type' => $type, 'url' => $url);
                
                return $result;
            }

function getAnchorList($url) {

    //regular expression để tìm tag a có chứa data-href
    $html = get_url_contents($url);

    $start = "<a ";
    $end = "</a>";
    
    //tìm tất cả các links phù hợp với regex cho vào mãng matchResult
    $match = get_all_string_between($html, $start, $end);
    //sử dụng hàm getLinkList để chuyển thành dữ liệu url và title
    print_r($match);die();
    $newArray = array();
    
    for ($i = 0; $i < count($match); $i++) {
        $newArray[] = anchor_categorize($match[$i]);
    }

    //$match1 = getLinkList($match);                         
    return $newArray;
}

function get_all_string_between($string, $start, $end) {
    $result = array();
    $string = " " . $string;
    $offset = 0;
    while (true) {
        $ini = strpos($string, $start, $offset);
        if ($ini == 0)
            break;
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        $result[] = substr($string, $ini, $len);
        $offset = $ini + $len;
    }
    return $result;
}

function getMetaInfo($url){
    $page=  get_url_contents($url);
    $start = "meta name=\"description\" content=\"";
    $end = "\">";
    $info = GetContentBetween($page, $start, $end);
    if($info){
        return $info;
    }
    return "Not Available.";
}