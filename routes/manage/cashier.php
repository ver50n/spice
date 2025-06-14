<?php
  $module = 'manage.cashier';
  $controller = 'Manage\CashierController';
  Route::get('/drawer', $controller.'@drawer')
    ->name($module.'.drawer')
    ->middleware([]);