<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'welcome.index', 'uses' => 'WelcomeController@index']);

Route::get('/videos/tag/{keyword}', 'VideosController@index');

Route::resource('/videos', 'VideosController', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);

Route::resource('/news', 'NewsController', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
Route::post('/news/parser', 'NewsController@ajaxGetNewsContent');

Route::get('/contact', 'ContactUsController@create');
Route::post('/contact/store', [
    'as' => 'contact.store',
    'uses' => 'ContactUsController@store',
]);
Route::get('/contact/success', [
    'as' => 'contact.success',
    'uses' => 'ContactUsController@success',
]);

Route::get('/about_us', 'WelcomeController@aboutUs');

Route::get('login', 'Auth\AuthController@showLoginForm');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('login/facebook', 'Auth\SocialAuthController@loginWithFacebook');
Route::get('login/callback/facebook', 'Auth\SocialAuthController@loginWithFacebookCallback');
