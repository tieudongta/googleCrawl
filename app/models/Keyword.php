<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Keyword extends Eloquent{
    
    protected $table="keywords";
    public function links(){
        return $this->hasMany('Link');
    }
    
    public function getKeyword(){
        return Keyword::orderBy('id',"DESC")->first(); 
        
    }
    public function getKeywordOnly($id){
        return Keyword::find($id)->only('keyword');
    }
}