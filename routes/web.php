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
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@profileSave')->name('profile.save');

Route::resource('cms-applications', 'CmsApplicationController');
Route::get('cms-plugins/{cms_plugin}/download', 'CmsPluginController@download')->name('cms-plugins.download');
Route::get('cms-plugins/upload', 'CmsPluginController@upload')->name('cms-plugins.upload');
Route::post('cms-plugins/get-plugin-latest-version', 'CmsPluginController@getPluginLatestVersion')->name('cms-plugins.get-plugin-latest-version');
Route::resource('cms-plugins', 'CmsPluginController')->except(['create', 'edit', 'update']);


Route::get('work-in-progress', function () {
    return view('wip');
})->name('work-in-progress');

Route::get('dev', function () {
    if (env('APP_ENV') != 'local') {
        abort(401, 'Development only');
    }
//    dd(\App\CmsPlugin::where([
//        ['vendor', 'PressStartOfficial'],
//        ['package', 'ExampleOne'],
//        ['version', '0.1.1'],
//    ])->get());

    dd([
        \Illuminate\Support\Facades\Storage::url("plugins/PressStartOfficial/ExampleOne/0.1.1/ExampleOne.zip")
    ]);
});
