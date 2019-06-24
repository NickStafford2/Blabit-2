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
 
Route::get(     '/',                            'HomeController@root')          ->name('root');
Route::get(     '/home',                        'HomeController@index')         ->name('home');
Route::get(     '/terms',                       'HomeController@terms')         ->name('terms');
Route::resource('chats',                        'ChatController');
Route::resource('users',                        'UserController');
Route::post(    'users/{user}/avatar',          'UserAvatarController@update');
Route::resource('blabs',                        'BlabController')               ->except(['index', 'edit', 'update']);
Route::post(    'blabs/{chat}',                 'BlabController@index')         ->name('blabs.index');
Route::post(    'blabs/requestUpdate/{info}',   'BlabController@requestUpdate') ->name('blabs.requestUpdate');
Route::resource('memes',                        'MemeController');
Route::post(    'memes/getUserMemes/{user_id}', 'MemeController@getUserMemes')  ->name('blabs.getUserMemes');
Route::post(    'memes/getMyMemes',             'MemeController@getMyMemes')    ->name('blabs.getMyMemes');
Route::post(    'memes/getChatMemes/{chat_id}', 'MemeController@getChatMemes')  ->name('blabs.getChatMemes');
Route::post(    'memes/attachChat/{request}',   'MemeController@attachChat')    ->name('blabs.attachChat');
Auth::routes(); 


//Route::get('/dashboard', function() {return view('/dashboard'); });
//Route::get('/chats/1', 'ChatsController@show');