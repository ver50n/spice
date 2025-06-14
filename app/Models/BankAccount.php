<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use session;
use Lang;
use App\Helpers\ApplicationConstant;

class BankAccount extends Model
{
    use \App\Traits\DataProviderTrait;
    public $table = 'bank_accounts';
    public $timestamps = false;
    protected $guarded = [];

    public function getUniqueLabelAttribute()
    {
        return $this->account_number.' - '.$this->account_name;
    }
    public function services()
    {
        return $this->hasMany(\App\Models\Service::Class);
    }

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'bank_code' => 'nullable|max:15',
                'bank_name' => 'required|max:255',
                'branch_code' => 'nullable|max:15',
                'branch_name' => 'nullable|max:255',
                'account_number' => 'required|max:30',
                'account_name' => 'required|max:255',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->fill($data);
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            
            return $validator->getMessageBag()->add('bank_name', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'bank_code' => 'nullable|max:15',
                'bank_name' => 'required|max:255',
                'branch_code' => 'nullable|max:15',
                'branch_name' => 'nullable|max:255',
                'account_number' => 'required|max:30',
                'account_name' => 'required|max:255',
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
            return $validator->getMessageBag()->add('name', $e->getMessage());
        }
    }
    
    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['bank_name']) && $filters['bank_name'] != "")
            $dp = $dp->where('bank_name', 'LIKE', '%'.$filters['bank_name'].'%');
        if(isset($filters['branch_name']) && $filters['branch_name'] != "")
            $dp = $dp->where('branch_name', 'LIKE', '%'.$filters['branch_name'].'%');
        if(isset($filters['account_number']) && $filters['account_number'] != "")
            $dp = $dp->where('account_number', 'LIKE', '%'.$filters['account_number'].'%');
        if(isset($filters['account_name']) && $filters['account_name'] != "")
            $dp = $dp->where('account_name', 'LIKE', '%'.$filters['account_name'].'%');

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
            'bank_code',
            'bank_name',
            'branch_code',
            'branch_name',
            'account_type',
            'account_number',
            'account_name',
            'services',
        ];
        foreach($csvColumns as $column) {
            $headers[] = \Lang::get('validation.attributes.'.$column);
        }
        $return[] = $headers;

        foreach($data as $objRow) {
            $row = [];
            foreach($csvColumns as $column) {
                $value = $objRow->$column;
                if($column == "services") {
                    $value = "";
                    foreach($objRow->services as $service) {
                        $value .= $service->name.', ';
                    }
                }
                $row[] = $value;
            }
            $return[] = $row;
        }
        return $return;
    }

}
