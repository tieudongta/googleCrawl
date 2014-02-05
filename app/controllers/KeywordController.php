<?php
set_time_limit(300);
class KeywordController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
            $keywords = Keyword::all();
            return View::make('keyword.index')->with('keywords',$keywords);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
        public function postIndex(){                
            $keyword = new Keyword;                     
            $keyword->keyword = Input::get('keyword');            
            $keyword->save();
            $lastKeyword = $keyword->getKeyword();
            $trimKeyword=  handleKeyword($lastKeyword->keyword);           
            $arrLinks = getLinkList1(handleKeyword($trimKeyword),$lastKeyword->id);
            $link = new Link;
            $arrLinksURL= $link->saveLinkList($arrLinks,$keyword->id);
            $anchor = new Anchor;
            $anchor->saveAnchorList($arrLinksURL);
            return Redirect::to('keyword');
        }
        
	
        public function show(){
            $keyword=Input::get('keyword');
            return View::make('tukhoa')->with('key',$keyword);
        }

}