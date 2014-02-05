<?php

class AnchorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
            $total = Anchor::all();
            $anchors = Anchor::paginate(10);
            return View::make('anchor.index')->with(array('anchors'=>$anchors,'total'=>$total));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
        public function getShow($link_id){
            $anchors = DB::table('anchors')->where('link_id',$link_id)->paginate(10);
            $link = Link::find($link_id);
            return View::make('anchor.show')->with(array('anchors'=>$anchors,'link'=>$link));
            
        }
        public function getDelete($id){
            $anchor = Anchor::find($id);
            $anchor->delete();
            return Redirect::back();
        }
	

}