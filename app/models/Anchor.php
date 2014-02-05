<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Anchor extends Eloquent{
    public function link(){
        return $this->belongsTo('Link','link_id');
    }
    public function saveAnchorList($data){
		//
            foreach($data as $d){
                $arrAnchors = findTagA1($d['link_url']);
                //DB::table()->insert($arrAnchors);
                
                    foreach($arrAnchors as $newArray){                   
                        $anchor = new Anchor;
                        $anchor->anchor_text =$newArray['title'];
                        $anchor->anchor_type =$newArray['type'];
                        $anchor->anchor_url =$newArray['url'];
                        $anchor->link_id = $d['link_id'];
                        $anchor->save();
                    }
            }
        }

}