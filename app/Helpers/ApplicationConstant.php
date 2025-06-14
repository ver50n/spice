<?php
namespace App\Helpers;

use Lang;
use App\Helpers\DropdownUtils;

class ApplicationConstant
{
    const YES_NO = [
        "0" => '0',
        "1" => '1'
    ];

    const LANGUAGE = [
        'id' => 'id',
        'en' => 'en',
        'ja' => 'ja',
    ];

    const GENDER = [
        'male' => 'male',
        'female' => 'female',
    ];

    const BANK_ACCOUNT_TYPE = [
        'regular' => 'regular',
        'commercial' => 'commercial'
    ];

    const USER_STATUS = [
        'temp' => 'temp',
        'registered' => 'registered',
        'verified' => 'verified'
    ];

    const ADMIN_ROLE = [
        'super_admin' => 'super_admin',
        'admin' => 'admin',
        'supervisor_cashier' => 'supervisor_cashier',
        'cashier' => 'cashier',
        'operator' => 'operator',
        'supervisor_operator' => 'supervisor_operator'
    ];
    
    const CURRENCY = [
        'IDR' => 'Rupiah',
        'JPY' => 'Yen',
    ];
    
    const PAYMENT_TYPE = [
        'cash' => 'cash',
        'bank_transfer' => 'bank_transfer',
        'cheque' => 'cheque',
    ];

    const PAYMENT_STATUS = [
        'waiting' => 'waiting',
        'partial' => 'partial',
        'done' => 'done',
        'overpaid' => 'overpaid',
    ];

    const PAYMENT_CONFIRMATION_STATUS = [
        'draft' => 'draft',
        'requested' => 'requested',
        'approved' => 'approved',
        'rejected' => 'rejected',
        'cancelled' => 'cancelled',
    ];

    const PRODUCT_CATEGORY = [
        'raw' => 'raw',
        'base' => 'base',
        'recipe' => 'recipe',
        'service' => 'service',
    ];

    const ASSET_CATEGORY = [
        'operational' => 'operational',
    ];

    const PURCHASE_CATEGORY = [
        'stock' => 'stock',
        'asset' => 'asset',
    ];

    const EXPENSE_CATEGORY = [
        'wage' => 'wage',
        'tax' => 'tax',
        'bonus' => 'bonus',
    ];

    const EXPENSE_STATUS = [
        'draft' => 'draft',
        'done' => 'done',
        'cancel' => 'cancel'
    ];

    const PURCHASE_STATUS = [
        'draft' => 'draft',
        'done' => 'done',
        'cancel' => 'cancel'
    ];

    const SALE_STATUS = [
        'draft' => 'draft',
        'done' => 'done',
        'cancel' => 'cancel'
    ];

    const ASSET_STATUS = [
        'in_use' => 'in_use',
        'rental' => 'rental',
        'broken' => 'broken',
        'disposed' => 'disposed',
    ];

    const SALE_TYPE = [
        'direct' => 'direct',
        'pickup' => 'pickup',
        'delivery' => 'delivery',
    ];

    const PURCHASE_FORMAT_CODE = 'PUR-[YmdHis]';
    const ASSET_FORMAT_CODE = 'AST-[YmdHis]';
    const SALE_FORMAT_CODE = 'SLS-[YmdHis]';
    const EXPENSE_FORMAT_CODE = 'EXP-[YmdHis]';


    public static function getDropdown($constant)
    {
        $return = [];
        $items = constant('self::'.$constant);

        foreach($items as $key => $value) {
            $return[$key] = \Lang::get('application-constant.'.$constant.'.'.$value);
        }

        return $return;
    }

    public static function getLabel($constant, $key)
    {
        $items = constant('self::'.$constant);

        return \Lang::get('application-constant.'.$constant.'.'.$items[$key]);
    }
}
