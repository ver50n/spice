<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currRoute = $request->route()->getName();
        $roleList = [
            'manage.dashboard' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],

            'manage.admin.list' => ['super_admin','admin'],
            'manage.admin.create' => ['super_admin','admin'],
            'manage.admin.createPost' => ['super_admin','admin'],
            'manage.admin.resetPasswordPost' => ['super_admin','admin'],
            'manage.admin.active' => ['super_admin','admin'],
            'manage.admin.inactive' => ['super_admin','admin'],
            'manage.admin.update' => ['super_admin','admin'],
            'manage.admin.updatePost' => ['super_admin','admin'],
            'manage.admin.view' => ['super_admin','admin'],
            
            'manage.customer.list' => ['super_admin','admin'],
            'manage.customer.create' => ['super_admin','admin'],
            'manage.customer.createPost' => ['super_admin','admin'],
            'manage.customer.active' => ['super_admin','admin'],
            'manage.customer.inactive' => ['super_admin','admin'],
            'manage.customer.update' => ['super_admin','admin'],
            'manage.customer.updatePost' => ['super_admin','admin'],
            'manage.customer.view' => ['super_admin','admin'],

            'manage.supplier.list' => ['super_admin','admin'],
            'manage.supplier.create' => ['super_admin','admin'],
            'manage.supplier.createPost' => ['super_admin','admin'],
            'manage.supplier.active' => ['super_admin','admin'],
            'manage.supplier.inactive' => ['super_admin','admin'],
            'manage.supplier.update' => ['super_admin','admin'],
            'manage.supplier.updatePost' => ['super_admin','admin'],
            'manage.supplier.view' => ['super_admin','admin'],

            'manage.bankAccount.list' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.create' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.createPost' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.view' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.update' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.updatePost' => ['super_admin','supervisor_cashier'],
            'manage.bankAccount.view' => ['super_admin','supervisor_cashier'],

            'manage.change-password-post' => ['super_admin','admin'],
            'manage.cashier.drawer' => ['super_admin','admin'],

            'manage.asset.list' => ['super_admin','admin'],
            'manage.asset.active' => ['super_admin','admin'],
            'manage.asset.inactive' => ['super_admin','admin'],
            'manage.asset.update' => ['super_admin','admin'],
            'manage.asset.updatePost' => ['super_admin','admin'],
            'manage.asset.view' => ['super_admin','admin'],

            'manage.event.list' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.create' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.createPost' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.active' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.delete' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.inactive' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.update' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.updatePost' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.event.view' => ['super_admin','admin','supervisor_operator','operator','supervisor_cashier','cashier'],

            'manage.help' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            'manage.login' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            'manage.login-post' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            'manage.logout' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            
            'manage.branch.list' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.create' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.createPost' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.active' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.inactive' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.update' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.updatePost' => ['super_admin','admin','supervisor_operator','operator'],
            'manage.branch.view' => ['super_admin','admin','supervisor_operator','operator'],
            
            'manage.product.list' => ['super_admin','admin','supervisor_operator'],
            'manage.product.view' => ['super_admin','admin','supervisor_operator'],
            'manage.product.create' => ['super_admin','admin','supervisor_operator'],
            'manage.product.createPost' => ['super_admin','admin','supervisor_operator'],
            'manage.product.update' => ['super_admin','admin','supervisor_operator'],
            'manage.product.updatePost' => ['super_admin','admin','supervisor_operator'],
            'manage.product.view' => ['super_admin','admin','supervisor_operator'],
            'manage.product.updateVariantItemPost' => ['super_admin','admin','supervisor_operator'],
            'manage.product.deleteVariantItemPost' => ['super_admin','admin','supervisor_operator'],
            
            'manage.sale.list' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.view' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.create' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.createPost' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.update' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.updatePost' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.view' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.updateSaleItemPost' => ['super_admin','admin','supervisor_operator'],
            'manage.sale.deleteSaleItemPost' => ['super_admin','admin','supervisor_operator'],

            'manage.purchase.list' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.view' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.create' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.createPost' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.update' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.updatePost' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.view' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.updatePurchaseItemPost' => ['super_admin','admin','supervisor_operator'],
            'manage.purchase.deletePurchaseItemPost' => ['super_admin','admin','supervisor_operator'],
            
            
            'manage.expense.list' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.view' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.create' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.createPost' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.update' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.updatePost' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.view' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.updateExpenseItemPost' => ['super_admin','admin','supervisor_operator'],
            'manage.expense.deleteExpenseItemPost' => ['super_admin','admin','supervisor_operator'],

            'manage.subscription.list' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.view' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.create' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.createPost' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.update' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.updatePost' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.view' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.updateSubscriptionItemPost' => ['super_admin','admin','supervisor_operator'],
            'manage.subscription.deleteSubscriptionItemPost' => ['super_admin','admin','supervisor_operator'],

            'manage.setting' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            'manage.saveSetting' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],
            'manage.setting-post' => ['super_admin','admin','supervisor_cashier','cashier','supervisor_operator','operator'],

        ];

        if(!Auth::guard('admin')->check()) {
            return redirect()->route('manage.login');
        } else {
            if(in_array(\Auth::guard('admin')->user()->role, $roleList[$currRoute]))
                return $next($request);
        }
        abort(403);
    }
}
