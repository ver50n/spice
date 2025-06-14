<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseController extends Controller
{
  public $routePrefix = 'manage.purchase';
  public $viewPrefix = 'manage.purchase';
  public $module = 'purchase';

  public function list(Request $request)
  {
    $obj = new Purchase();
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
    $obj = new Purchase();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $asset = new Purchase();

    $result = $asset->add($data);

    if($result instanceof Purchase) {
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
    $obj = Purchase::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Purchase::findOrFail($request->id);

    $result = $obj->edit($data);

    if($result instanceof Purchase) {
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
    $obj = Purchase::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePurchaseItemPost(Request $request)
  {
    $purchaseId = $request->id;
    $obj = Purchase::findOrFail($purchaseId);
    $data = $request->all();
    
    $prs = new PurchaseDetail();
    if($data['purchase_detail_id']) {
      $prs = PurchaseDetail::findOrFail($data['purchase_detail_id']);
    }
    $result = $prs->edit($data);

    if($result instanceof PurchaseDetail) {
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
  
  public function deletePurchaseItemPost(Request $request)
  {
    $purchaseId = $request->id;
    $obj = Purchase::findOrFail($purchaseId);
    $detail = PurchaseDetail::findOrFail($request->purchase_detail_id);
    $result = $detail->delete();

    return redirect()
        ->back()
        ->with('success', \Lang::get('common.delete-succeed', ['module' => \Lang::get('common.'.$this->module)]));
  }
}