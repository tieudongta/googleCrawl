<?php

class LinkController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
            $links = Link::paginate(10);
            return View::make('link.index')->with('links',$links);
	}

	
        
	public function getLinklist($keyword_id)
	{
      
            $links = Link::where('keyword_id','=',$keyword_id)->take(10)->get();
            
            
            return View::make('link.show')->with('results',$links);
	}
        
        public function postLinklist($keyword,$keyword_id){
            $file1 =  "http://www.google.com.vn/search?q=".$keyword;
            //$file = "http://www.google.com";            
	    $html=  file_get_contents($file1);
            //regular expression để tìm tag a có chứa data-href
            $start="<a href=\"/url";
            $end="</a>";        
            //tìm tất cả các links phù hợp với regex cho vào mãng matchResult
            $match = get_all_string_between($html, $start, $end);
            //sử dụng hàm getLinkList để chuyển thành dữ liệu url và title
            $match1 = getLinkList($match);
            foreach($match1 as $match2){
                $link = new Link;                              
                $link->title = $match2['title'];                
                $link->url = $match2['url'];
                $link->keyword_id =$keyword_id;              
                $link->save();                
            }
            return Rediect::to('keyword.index');
        }
       		
}