<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Link extends Eloquent{
    public function keyword()
    {
        return $this->belongsTo('Keyword','keyword_id');
    }
    public function anchors(){
        return $this->hasMany('Anchor');
    }
    public function getLinkId(){
        return Link::orderBy('id',"DESC")->first(); 
        
    }
    public function saveLinkList($listLink,$keyword_id){
        $result=array();
        foreach($listLink as $k => $Link){
            $link = new Link;                             
            $link->title = $Link['title'];                
            $link->url = $Link['url'];
            $link->meta_info = $Link['meta'];
            $link->keyword_id =$keyword_id;
            $link->save();
            $link_id = $link->getLinkId()->id;
            $result[$k]['link_id']=$link_id;
            $result[$k]['link_url']=$Link['url'];
            
        }
        return $result;
    }
}