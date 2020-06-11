<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//前台路由
Route::group(['namespace'=>'Home'],function(){
    //前台
    Route::get("/","IndexController@index");
    Route::get("/index/{pagew?}","IndexController@index");
    Route::get("/articleShow/{id}","IndexController@article");
    Route::get("articleCategory/{category}","IndexController@articleByCategory");
    Route::get("/article/comment/{id}","IndexController@_articleComment");
    Route::post("/article/{id}","IndexController@articleComment");
    Route::get("/login","IndexController@login");
    Route::post("/check","IndexController@check");
    Route::post("/userCheck","IndexController@userCheck");
    //推出操作路由
    Route::get("/loginOut","IndexController@loginOut");
});
//后台路由
Route::group(['namespace'=>'Admin','prefix'=>'admin',"middleware"=>'test'],function(){
    //前台
    Route::get("/","IndexController@index");
    Route::get("/info","IndexController@info");
    Route::get("/add","IndexController@add");
    Route::post("/_add","IndexController@_add");
    Route::get("article/createView","ArticleController@createView");
    Route::resource("article","ArticleController");
    Route::post("article/create","ArticleController@create");
    Route::post("article/upLoadFile","ArticleController@upLoadFile");
    Route::post("article/{article}/saveEdit","ArticleController@saveEdit");
    //文章类别路由
    Route::resource("category","CategoryController");
    //公告路由
    Route::resource("announce","AnnounceController");
    //用户路由
    Route::resource("user","UserController");
});//

Route::resource('comment', 'CommentController');
Route::resource('reply', 'ReplyController');


Route::get('testRedis','RedisController@testRedis')->name('testRedis');

//Route::get("index/login","IndexController@login");




