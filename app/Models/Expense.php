<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Lang;
use App\Helpers\ApplicationConstant;

class Expense extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'expenses';
    protected $guarded = [];

    protected $casts = [
        'expense_at' => 'date:Y-m-d',
        'payment_at' => 'date:Y-m-d',
    ];

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $this->expense_cd = \App\Utils\PatternCodeUtil::generate(\App\Helpers\ApplicationConstant::EXPENSE_FORMAT_CODE)."_".$now->format("u");
            $this->payment_status = "waiting";
            $this->expense_status = "draft";
            $this->fill($data);
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            
            return $validator->getMessageBag()->add('transaction_cd', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);            
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('transaction_cd', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }

    public function csvFormatter($data)
    {
        $headers = [];
        $return = [];

        $csvColumns = [
            'id',
            'name',
            'is_active',
        ];
        foreach($csvColumns as $column) {
            $headers[] = \Lang::get('validation.attributes.'.$column);
        }
        $return[] = $headers;

        foreach($data as $objRow) {
            $row = [];
            foreach($csvColumns as $column) {
                $value = $objRow->$column;
                if($column == 'branch_id')
                    $value = $objRow->branch->name;
                if($column == 'is_active')
                    $value = Lang::get('application-constant.YES_NO.'.$objRow->is_active);
                $row[] = $value;
            }
            $return[] = $row;
        }
        return $return;
    }
}
