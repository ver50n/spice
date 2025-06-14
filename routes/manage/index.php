<?php
  $module = 'manage';
  Route::get('/', 'Manage\ManageController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['AdminAuthentication']);

  Route::get('/login', 'Manage\LoginController@login')
    ->name($module.'.login')
    ->middleware([]);
  Route::post('/login', '\App\Http\Controllers\Manage\LoginController@loginPost')
    ->name($module.'.login-post')
    ->middleware([]);

  Route::post('/logout', 'Manage\LoginController@logout')
    ->name($module.'.logout')
    ->middleware([]);
    
// Setting
Route::get('/setting', 'Manage\ManageController@setting')
  ->name($module.'.setting')
  ->middleware(['AdminAuthentication']);
Route::post('/setting', 'Manage\ManageController@saveSetting')
  ->name($module.'.saveSetting')
  ->middleware(['AdminAuthentication']);

Route::post('/change-password-post', 'Manage\ManageController@changePasswordPost')
  ->name($module.'.change-password-post')
  ->middleware(['AdminAuthentication']);
Route::post('/account-post', 'Manage\ManageController@accountPost')
  ->name($module.'.account-post')
  ->middleware(['AdminAuthentication']);
Route::post('/setting-post', 'Manage\ManageController@settingPost')
  ->name($module.'.setting-post')
  ->middleware(['AdminAuthentication']);
    
  Route::prefix('/admin')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/admin.php'));
  Route::prefix('/supplier')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/supplier.php'));
  Route::prefix('/customer')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/customer.php'));
  Route::prefix('/branch')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/branch.php'));
  Route::prefix('/asset')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/asset.php'));
  Route::prefix('/bank-account')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/bankAccount.php'));
  Route::prefix('/product')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/product.php'));
  Route::prefix('/purchase')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/purchase.php'));
  Route::prefix('/sale')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/sale.php'));
  Route::prefix('/expense')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/expense.php'));
  Route::prefix('/cashier')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/cashier.php'));
  Route::prefix('/report')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/report.php'));