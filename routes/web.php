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


Auth::routes();

// prevent user confused with his old site
Route::get('admin',function (){
    return redirect('/login');
});
// for error redirection
Route::get('/404',function (){
    return view('errors.404');
});
Route::get('/500',function (){
    return view('errors.500');
});

//---------------------------------------frontend routes---------------------------------------
// Matches The "/frontend/controllers"
Route::group(['namespace' => 'frontend'],function () {
    Route::get('/','HomePageController@index');
    Route::get('/page/{id}','HomePageController@page');
    Route::get('/page/{id}/{news_id}','HomePageController@pageDetail');
    Route::get('/tag/{tagname}','HomePageController@tag');
    Route::get('/search','HomePageController@search');
    Route::get('/onlinesportstv', 'HomePageController@ots');

    //Facebook Instant Article
    Route::get('rss-feed',function(){
        /*Create new feed*/
        $feed = App::make('feed');
        $posts = \App\Content::where('delete_statue',0)->orderBy('publish_date','desc')->take(10)->get();

        $feed->title="កីឡាដេលី | Keila Daily - Leading Sports News in Cambodia";
        $feed->description="The Leading Sports News in Cambodia and The Vital Sources To Bring Khmer Sports to Sea Games 2023.";
        $feed->logo="http://keiladaily.com/img/kd-logo.png";
        $feed->link=url("feed");
        $feed->setDateFormat('datetime');
//        $feed->pubdate=$posts[0]->publish_date;
        $relates = \App\Content::where('delete_statue',0)->where('id','<>',$posts[0]->id)->orderBy('publish_date','desc')->limit(3)->get();
        foreach($posts as $post){
            $author="Keila Daily";
            $link=URL('page',[$post->getMenu->c_id,$post->id]);
            $purify = removePtag($post->full_text);
            $feed->add($post->text_title,$author,URL::to($link),$post->publish_date,$post->description,$purify,$post->id,$post->getMenu->c_title,$post->media,$post->id,$relates);
        }

        return $feed->render('rss');
    });

});

//---------------------------------------end frontend routes------------------------------------

//-------------------------------------backend routes-------------------------------------------
//Matches The namespace "/backend/controller and url admin/... "
Route::group(['namespace' => 'backend', 'prefix' => 'admin'],function (){
    Route::get('dashboard','DashboardController@index')->name('backend.dashboard');
    // User profile
    Route::get('profile','DashboardController@profile')->name('backend.profile');
    // Search contents
    Route::get('search','DashboardController@search')->name('backend.search');


    // For contents
    Route::get('content','ContentController@index')->name('backend.content');
    Route::get('content/add','ContentController@create')->name('backend.content.add');
    Route::post('content/add','ContentController@store')->name('backend.content.store');
    Route::get('content/delete/{id}','ContentController@destroy')->name('backend.content.delete');
    Route::get('content/edit/{id}','ContentController@edit')->name('backend.content.edit');
    Route::post('content/edit/{id}','ContentController@update')->name('backend.content.update');

    // For slideshow
    Route::get('slide','SlideController@index')->name('backend.slide');
    Route::get('slide/add','SlideController@create')->name('backend.slide.add');
    Route::post('slide/add','SlideController@store')->name('backend.slide.store');
    Route::get('slide/edit/{id}','SlideController@edit')->name('backend.slide.edit');
    Route::post('slide/edit/{id}','SlideController@update')->name('backend.slide.update');
    Route::get('slide/delete/{id}','SlideController@destroy')->name('backend.slide.delete');

    // For menu
    Route::get('menu','MenuController@index')->name('backend.menu');
    Route::get('menu/add','MenuController@create')->name('backend.menu.add');
    Route::post('menu/add','MenuController@store')->name('backend.menu.store');
    Route::get('menu/delete/{id}','MenuController@destroy')->name('backend.menu.delete');
    Route::get('menu/edit/{id}','MenuController@edit')->name('backend.menu.edit');
    Route::post('menu/edit/{id}','MenuController@update')->name('backend.menu.update');

    // For users
    Route::get('user','UserController@index')->name('backend.user');
    Route::get('user/add','UserController@create')->name('backend.user.add');
    Route::get('user/edit/{id}','UserController@edit')->name('backend.user.edit');
    Route::post('user/edit/{id}','UserController@update')->name('backend.user.update');
    Route::post('user/profile/{id}','UserController@profile')->name('backend.user.profile');
    Route::get('user/delete/{id}','UserController@destroy')->name('backend.user.delete');

    // For Tag
    Route::get('tag','TagController@index')->name('backend.tag');
    Route::get('tag/add','TagController@create')->name('backend.tag.add');
    Route::post('tag/add','TagController@store')->name('backend.tag.store');
    Route::get('tag/delete/{id}','TagController@destroy')->name('backend.tag.delete');
    Route::get('tag/edit/{id}','TagController@edit')->name('backend.tag.edit');
    Route::post('tag/edit/{id}','TagController@update')->name('backend.tag.update');
});

//---------------------------------------End backend routes---------------------------------------------