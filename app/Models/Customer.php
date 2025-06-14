<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Lang;
use App\Helpers\ApplicationConstant;

class Customer extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'customers';
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::Class);
    }

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'nullable|email|unique:users,email',
                'phone' => 'required|numeric|digits_between:9,13',
                'address' => 'required|max:1000'
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
            
            return $validator->getMessageBag()->add('name', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'nullable|email|unique:users,email,'.$this->id,
                'phone' => 'required|numeric|digits_between:9,13',
                'address' => 'required|max:1000'
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

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');
        if(isset($filters['branch_id']) && $filters['branch_id'] != "")
            $dp = $dp->where('branch_id', $filters['branch_id']);
        if(isset($filters['phone']) && $filters['phone'] != "")
            $dp = $dp->where('phone', 'LIKE', '%'.$filters['phone'].'%');
        if(isset($filters['email']) && $filters['email'] != "")
            $dp = $dp->where('email', 'LIKE', '%'.$filters['email'].'%');
        if(isset($filters['address']) && $filters['address'] != "")
            $dp = $dp->where($this->table.'.address', 'LIKE', '%'.$filters['address'].'%');

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
            'branch_id',
            'phone',
            'address',
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
