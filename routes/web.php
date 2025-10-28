<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$namespace = 'App\\Http\\Controllers';


Route::get('/', $namespace.'\FrontController@index')->name('landing')->middleware(['Locale']);

Route::get('/products', $namespace.'\FrontController@products')->name('products')->middleware(['Locale']);
Route::get('/about', $namespace.'\FrontController@about')->name('about')->middleware(['Locale']);
Route::get('/contact', $namespace.'\FrontController@contact')->name('contact')->middleware(['Locale']);

/* Helper Routes */
Route::post('/helpers/change-locale',['as' => 'helpers.change-locale', 'uses' => $namespace.'\HelperController@changeLocale']);
Route::get('/helpers/load-event',['as' => 'helpers.load-event', 'uses' => $namespace.'\HelperController@loadEvent']);
Route::get('/helpers/download-file',['as' => 'helpers.download-file', 'uses' => $namespace.'\HelperController@downloadFile']);
Route::post('/helpers/change-row-per-page', ['as' => 'helpers.change-row-per-page', 'uses' => $namespace.'\HelperController@changeRowPerPage']);
Route::post('/helpers/export', ['as' => 'helpers.export', 'uses' => $namespace.'\HelperController@export']);
Route::post('/helpers/activation', ['as' => 'helpers.activation', 'uses' => $namespace.'\HelperController@activation']);
Route::prefix('/manage')->middleware(['Locale'])->namespace($namespace)->group(base_path('routes/manage/index.php'));