<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Branch;

class CashierController extends Controller
{
  public $routePrefix = 'manage.cashier';
  public $viewPrefix = 'manage.cashier';
  public $module = 'cashier';

  public function drawer(Request $request)
  {
    
    $cash = [
      [
        'cash_id' => 500,
        'cash_qty' => 3,
        'cash_total' => 1500,
      ],
      [
        'cash_id' => 1000,
        'cash_qty' => 30,
        'cash_total' => 300000,
      ],
      [
        'cash_id' => 2000,
        'cash_qty' => 10,
        'cash_total' => 20000,
      ],
      [
        'cash_id' => 5000,
        'cash_qty' => 3,
        'cash_total' => 1500,
      ],
      [
        'cash_id' => 10000,
        'cash_qty' => 6,
        'cash_total' => 60000,
      ],
      [
        'cash_id' => 20000,
        'cash_qty' => 4,
        'cash_total' => 80000,
      ],
      [
        'cash_id' => 50000,
        'cash_qty' => 3,
        'cash_total' => 15000,
      ],
      [
        'cash_id' => 100000,
        'cash_qty' => 1,
        'cash_total' => 100000,
      ],
    ];
    return view($this->viewPrefix.'.drawer', [
      'cash' => $cash
    ]);
  }
}