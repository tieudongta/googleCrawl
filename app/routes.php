<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
include_once 'helper/common.php';

Route::any('/', function(){
    return Redirect::to('keyword/index');
});

Route::controller('keyword','KeywordController');
Route::controller('link','LinkController');
Route::controller('anchor','AnchorController');


