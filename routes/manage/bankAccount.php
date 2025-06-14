<?php
  $module = 'manage.bankAccount';
  $controller = 'Manage\BankAccountController';
  Route::get('/', $controller.'@list')
    ->name($module.'.list')
    ->middleware([]);
  Route::get('/create', $controller.'@create')
    ->name($module.'.create')
    ->middleware([]);
  Route::post('/create', $controller.'@createPost')
    ->name($module.'.createPost')
    ->middleware([]);
  Route::get('/{id}', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);
  Route::get('/{id}/update', $controller.'@update')
    ->name($module.'.update')
    ->middleware([]);
  Route::post('/{id}/update', $controller.'@updatePost')
    ->name($module.'.updatePost')
    ->middleware([]);
  Route::get('/{id}/view', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);
  Route::post('/{id}/delete', $controller.'@delete')
    ->name($module.'.delete')
    ->middleware([]);