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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('cms-applications', 'CmsApplicationController');
Route::resource('cms-plugins', 'CmsPluginController');
Route::get('cms-plugins/{cms_plugin}/download', 'CmsPluginController@download')->name('cms-plugins.download');
