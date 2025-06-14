<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$namespace = 'App\\Http\\Controllers';

/* Helper Routes */
Route::get('/', function (Request $request) {
    return redirect()->to(route('manage.dashboard'));
})->name('dashboard')->middleware([]);

Route::post('/helpers/change-locale',['as' => 'helpers.change-locale', 'uses' => $namespace.'\HelperController@changeLocale']);
Route::get('/helpers/load-event',['as' => 'helpers.load-event', 'uses' => $namespace.'\HelperController@loadEvent']);
Route::get('/helpers/download-file',['as' => 'helpers.download-file', 'uses' => $namespace.'\HelperController@downloadFile']);
Route::post('/helpers/change-row-per-page', ['as' => 'helpers.change-row-per-page', 'uses' => $namespace.'\HelperController@changeRowPerPage']);
Route::post('/helpers/export', ['as' => 'helpers.export', 'uses' => $namespace.'\HelperController@export']);
Route::post('/helpers/activation', ['as' => 'helpers.activation', 'uses' => $namespace.'\HelperController@activation']);
Route::prefix('/manage')->middleware([])->namespace($namespace)->group(base_path('routes/manage/index.php'));