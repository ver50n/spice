<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Subscription;
use App\Models\SubscriptionDetail;

class SubscriptionController extends Controller
{
  public $routePrefix = 'manage.subscription';
  public $viewPrefix = 'manage.subscription';
  public $module = 'subscription';

  public function list(Request $request)
  {
    $obj = new Subscription();
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
    $obj = new Subscription();

    return view($this->viewPrefix.'.create', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function createPost(Request $request)
  {
    $data = $request->all();
    $subscription = new Subscription();

    $result = $subscription->add($data);

    if($result instanceof Subscription) {
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
    $obj = Subscription::findOrFail($request->id);

    return view($this->viewPrefix.'.update', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function updatePost(Request $request)
  {
    $data = $request->all();
    $obj = Subscription::findOrFail($request->id);

    $result = $obj->edit($data);

    if($result instanceof Subscription) {
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

  public function updateSubscriptionItemPost(Request $request)
  {
    $subscriptionId = $request->id;
    $obj = Subscription::findOrFail($subscriptionId);
    $data = $request->all();
    
    $prs = new SubscriptionDetail();
    if($data['subscription_detail_id']) {
      $prs = SubscriptionDetail::findOrFail($data['subscription_detail_id']);
    }
    $result = $prs->edit($data);

    if($result instanceof SubscriptionDetail) {
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
  
  public function deleteSubscriptionItemPost(Request $request)
  {
    $subscriptionId = $request->id;
    $obj = Subscription::findOrFail($subscriptionId);
    $detail = SubscriptionDetail::findOrFail($request->subscription_detail_id);
    $result = $detail->delete();

    return redirect()
        ->back()
        ->with('success', \Lang::get('common.delete-succeed', ['module' => \Lang::get('common.'.$this->module)]));
  }

  public function view(Request $request)
  {
    $obj = Subscription::findOrFail($request->id);

    return view($this->viewPrefix.'.view', [
      'obj' => $obj,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }
}