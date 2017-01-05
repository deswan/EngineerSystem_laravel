<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'HomeController@index');
Route::get('/course_list', 'HomeController@courses');
Route::get('/course_list/{type}', 'HomeController@course_list');
Route::get('/course/{course}/collect', 'HomeController@course_collect')->middleware('auth');
Route::get('/course/{course}/collect/validate', 'HomeController@course_collect_validate');
Route::get('/news/{type}', 'HomeController@news');

//下载    !!模型绑定:路径中{video}名字要和控制器方法参数名称一致!!
Route::get('download/video/{video}','HomeController@download_video');
Route::get('download/textbook/{textbook}','HomeController@download_textbook');


Route::group(['namespace'=>'Auth','prefix'=>'user'],function(){
    Route::get('/login','LoginController@showLoginForm');
    Route::post('/login','LoginController@login');
    Route::post('/login/validate','LoginController@loginAjax');
    Route::get('/register','RegisterController@showRegistrationForm');
    Route::post('/register','RegisterController@register');
    Route::post('/register/validate','RegisterController@registerAjax');
    Route::get('/logout','LoginController@logout');
});
Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
    Route::get('/courses','UserController@courses');
    Route::group(['prefix'=>'course'],function() {
        //详情页面
        Route::get('/{course}/video', 'UserController@video_list');
        Route::get('/{course}/textbook', 'UserController@textbook_list');
        Route::get('/{course}/exam', 'UserController@exam');
        Route::post('/{course}/exam', 'UserController@exam_deal');
    });
    Route::get('/video/{video}/play', 'UserController@play');
});

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
    Route::get('/login','LoginController@showLoginForm');
    Route::post('/login','LoginController@login');
    Route::post('/login/validate','LoginController@loginAjax');
    Route::get('/register','RegisterController@showRegistrationForm');
    Route::post('/register','RegisterController@register');
    Route::post('/register/validate','RegisterController@registerAjax');
    Route::get('/logout','LoginController@logout');
});


Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth:admin'],function(){
    //我的课程
    Route::get('/courses','AdminController@courses');
    Route::get('/add_course','AdminController@add_course');
    Route::post('/add_course','AdminController@add_course_deal');
    Route::post('/add_course/validate','AdminController@add_course_validate');
    Route::group(['prefix'=>'course'],function(){
        //详情页面
        Route::get('/{course}/video','AdminController@video_list');
        Route::get('/{course}/textbook','AdminController@textbook_list');
        //上传页面
        Route::get('/{course}/upload/video','AdminController@upload_video');
        Route::get('/{course}/upload/textbook','AdminController@upload_textbook');
        Route::get('/{course}/upload/exam','AdminController@upload_exam');
        //ajax
        Route::post('/{course}/upload/video/validate','AdminController@upload_video_validate');
        Route::post('/{course}/upload/textbook/validate','AdminController@upload_textbook_validate');
        //处理上传
        Route::post('/{course}/upload/video','AdminController@upload_video_deal');
        Route::post('/{course}/upload/textbook','AdminController@upload_textbook_deal');
        Route::post('/{course}/upload/exam','AdminController@upload_exam_deal');
        //删除
        Route::get('/video/{video}/delete','AdminController@delete_video');
        Route::get('/textbook/{textbook}/delete','AdminController@delete_textbook');
        Route::get('/exam/{course}/delete','AdminController@delete_exam');

        Route::get('/video/{video}/play', 'AdminController@play');
    });
    //我的资讯
    Route::get('/news','AdminController@news');
    Route::group(['prefix'=>'news'],function(){
        Route::get('/upload','AdminController@upload_news');
        Route::post('/upload','AdminController@upload_news_deal');
        Route::get('/{information}/delete','AdminController@delete_news');
    });


});


Route::get('/home', 'HomeController@index');
