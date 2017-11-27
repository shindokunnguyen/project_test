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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// route for user
Route::resource('users', 'UserController');

// route for article
Route::resource('articles', 'ArticleController');

// router update like article
// Route::post('/like/updatelike', 'LikeController@updatelike');
Route::post('like/updatelike', 'LikeController@updatelike');

// route comment article
Route::post('comment/add', 'CommentController@add');

// route load list comment by article
Route::post('comment/loadcomment', 'CommentController@loadcomment');

// route delete article
Route::post('article/deletearticle', 'ArticleController@deletearticle');
