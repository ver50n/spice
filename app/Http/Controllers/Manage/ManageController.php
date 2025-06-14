<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Admin;
use App\Models\User;
use App\Models\Payment;
use \App\Utils\RequestServiceUtil;
use DateTime;
use DateInterval;

class ManageController extends Controller
{
    public function dashboard()
    {

        return view('manage.dashboard', [
        ]);
    }

    public function help()
    {
        return view('manage.help', [
        ]);
    }

    public function setting()
    {
        $id = \Auth::guard('admin')->id();
        $obj = Admin::findOrFail($id);
        
        return view('manage.setting', [
            'obj' => $obj
        ]);
    }

    public function saveSetting(Request $request)
    {
        $id = \Auth::guard('admin')->id();
        $data = $request->all();
        $obj = Admin::findOrFail($id);
        $result = $obj->saveSetting($data);

        if($result instanceof Admin)
            return redirect()->back()
                ->with('success', \Lang::get('common.update-account-succeed'));

        return redirect()->back()
            ->with('error', \Lang::get('common.update-account-failed'))
            ->withInput($data)
            ->withErrors($result);
    }

    public function changePasswordPost(Request $request)
    {
        $id = \Auth::guard('admin')->id();
        $data = $request->all();
        $obj = Admin::findOrFail($id);
        $result = $obj->changePassword($data);

        if($result instanceof Admin)
            return redirect()->back()
                ->with('success', \Lang::get('common.change-password-succeed'));

        return redirect()->back()
            ->with('error', \Lang::get('common.change-password-failed'))
            ->withErrors($result);
    }
}