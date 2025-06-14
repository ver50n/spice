<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Sale;
use App\Models\SaleVariant;

class SaleController extends Controller
{
  public $routePrefix = 'manage.sale';
  public $viewPrefix = 'manage.sale';
  public $module = 'sale';

  public function list(Request $request)
  {
    $obj = new Sale();
    $filters = $request->query('filters');
    $page = $request->query('page');
    $sort = $request->query('sort');

    if($filters)
      $obj->fill($filters);
      
    $data = $obj->filter($filters, [
      'pagination' => true,
      'page' => $page,
      'sort' => $sort
    ]);

    return view($this->viewPrefix.'.list', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function create()
  {
    $obj = new Sale();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $sale = new Sale();

    $result = $sale->add($data);

    if($result instanceof Sale) {
      return redirect()->route($this->routePrefix.'.update', ['id' => $result->id])
        ->with('success', \Lang::get('common.create-succeed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.create-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($result);
  }

  public function update(Request $request)
  {
    $obj = Sale::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Sale::findOrFail($request->id);

    $result = $obj->edit($data);

    if($result instanceof Sale) {
      return redirect()
        ->back()
        ->with('success', \Lang::get('common.update-succeed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.update-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($result);
  }

  public function view(Request $request)
  {
    $obj = Sale::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }
  
  public function updateVariantItemPost(Request $request)
  {
    $data = $request->all();
    $data['sale_id'] = $request->id;

    $obj = new SaleVariant();
    if($data['sale_variant_id'])
      $obj = SaleVariant::findOrFail($data['sale_variant_id']);
    $result = $obj->edit($data);

    if($result instanceof SaleVariant) {
      return redirect()
        ->back()
        ->with('success', \Lang::get('common.update-succeed', ['module' => \Lang::get('common.'.$this->module)]));
    }

    return redirect()
      ->back()
      ->with('error', \Lang::get('common.update-failed', ['module' => \Lang::get('common.'.$this->module)]))
      ->withInput($data)
      ->withErrors($result);
  }

  public function deleteVariantItemPost(Request $request)
  {
    $obj = SaleVariant::findOrFail($request->variant_id);
    $obj->remove();

    return redirect()
      ->back()
      ->with('success', \Lang::get('common.delete-request-succeed', ['module' => \Lang::get('common.'.$this->module)]));
  }
}