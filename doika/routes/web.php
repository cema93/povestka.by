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

///////////////////////////////////////////////////////////////////////////////
// наладочные маршруты
//Route::get('/list', 'DevController@getListPage');
//Route::get('/campaign', 'DevController@getCampaignPage');
//Route::get('/configuration', 'DevController@getConfigurationPage');
////////////////////////////////////////////////////////////////////////////////


Route::group(['middleware' => 'auth'], function () {
// routes Campaigns
Route::get('/create', 'DevController@getCreatePage');
Route::post('/create', 'CampaignAdminController@create');
Route::get('/show-campaign-{id}', 'CampaignAdminController@show')->where('id', '[0-9]+');
Route::post('/update-campaign-{id}', 'CampaignAdminController@update')->where('id', '[0-9]+');
Route::get('/delete-campaign-{id}', 'CampaignAdminController@delete')->where('id', '[0-9]+');
Route::get('/show-list', 'CampaignAdminController@showList');
Route::get('/show-list-{id}','CampaignAdminController@showListConditions')->where('id', '[0-9]+');
Route::get('/get-out', 'CampaignAdminController@getOut');

// routes Configurations
Route::get( '/show-configurations', 'ConfigurationAdminController@showConfigurations');
Route::post('/show-configurations', 'ConfigurationAdminController@showConfigurations');
Route::post('/save-configurations', 'ConfigurationAdminController@saveConfigurations');
Route::post('/save-login', 'ConfigurationAdminController@changePassword');




Route::get('/doika', 'CampaignAdminController@showList');

});
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/client-{id}', 'CampaignClientController@getCampaignClient')->where('id', '[0-9]+');
Route::get('/short-client-{id}', 'CampaignClientController@getShotrCampaignClient')->where('id', '[0-9]+');
Route::get('/donate-{id}', 'DonateController@donate')->where('id', '[0-9]+');
Route::post('/payment-record-db-{id}', 'DonateController@recordPayment')->where('id', '[0-9]+');
Route::get('/payment-record-db-{id}', 'DonateController@recordPayment')->where('id', '[0-9]+');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/doika/home', 'HomeController@index')->name('home');
//Route::get('home', 'HomeController@index')->name('home');
//Route::get('doika/home', 'HomeController@index')->name('home');
