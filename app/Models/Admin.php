<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Lang;
use App\Helpers\ApplicationConstant;

class Admin extends Authenticatable
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'admins';
    protected $guarded = ['confirm_password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getUniqueLabelAttribute()
    {
        return $this->name.' - '.$this->role;
    }
    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::Class);
    }

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'id_number' => 'required|max:30',
                'name' => 'required|max:100',
                'branch_id' => 'required|exists:branches,id',
                'role' => 'required|in:'.implode(',', array_keys(\App\Helpers\ApplicationConstant::ADMIN_ROLE)),
                'username' => 'required|max:100|regex:/^[a-z0-9_.-]*$/|unique:admins,username',
                'email' => 'nullable|max:100|unique:admins,email|email',
                'password' => 'required|alpha_num|min:6|max:10',
                'confirm_password' => 'required|alpha_num|min:6|max:10|same:password',
                'dob' => 'required|date_format:Y-m-d',
                'start_work_at' => 'required|date_format:Y-m-d',
                'end_work_at' => 'nullable|date_format:Y-m-d',
                'gender' => 'required|in:'.implode(',', ApplicationConstant::GENDER),
                'phone' => 'required|numeric|digits_between:9,13',
                'address' => 'required|max:1000',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);
            $this->password = bcrypt($data['password']);
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'id_number' => 'required|max:30',
                'name' => 'required|max:100',
                'branch_id' => 'required|exists:branches,id',
                'role' => 'required|in:'.implode(',', array_keys(\App\Helpers\ApplicationConstant::ADMIN_ROLE)),
                'username' => 'required|max:100|regex:/^[a-z0-9_.-]*$/|unique:admins,username,'.$this->id,
                'email' => 'nullable|max:100|email|unique:admins,email,'.$this->id,
                'password' => 'nullable|alpha_num|min:6|max:10',
                'confirm_password' => 'nullable|alpha_num|min:6|max:10|same:password',
                'dob' => 'required|date_format:Y-m-d',
                'start_work_at' => 'required|date_format:Y-m-d',
                'end_work_at' => 'nullable|date_format:Y-m-d',
                'gender' => 'required|in:'.implode(',', ApplicationConstant::GENDER),
                'phone' => 'required|numeric|digits_between:9,13',
                'address' => 'required|max:1000',
            ];
            
            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);
            if($data['password'])
                $this->password = bcrypt($data['password']);
            else
                unset($this->password);
            
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function resetPassword()
    {
        $this->password = bcrypt('admin123');
        $this->save();
    }

    public function saveSetting($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'username' => 'required|max:100|regex:/^[a-z0-9_.-]*$/|unique:admins,username,'.$this->id,
                'email' => 'required|max:100|email|unique:admins,email,'.$this->id,
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
            return $validator->getMessageBag()->add('username', $e->getMessage());
        }
    }

    public function changePassword($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'password' => 'alpha_num|min:6|max:10',
                'confirm_password' => 'alpha_num|min:6|max:10|same:password',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->password = bcrypt($data['password']);
            $this->save();

            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['role']) && $filters['role'] != "")
            $dp = $dp->where('role', $filters['role']);

        if(isset($filters['username']) && $filters['username'] != "")
            $dp = $dp->where('username', 'LIKE', '%'.$filters['username'].'%');

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');

        if(isset($filters['email']) && $filters['email'] != "")
            $dp = $dp->where($this->table.'.email', 'LIKE', '%'.$filters['email'].'%');

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
            'role',
            'name',
            'username',
            'email',
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
                if($column == 'is_active')
                    $value = Lang::get('application-constant.YES_NO.'.$objRow->is_active);
                if($column == "role")
                    $value = Lang::get('application-constant.ADMIN_ROLE.'.ApplicationConstant::ADMIN_ROLE[$objRow->role]);
                $row[] = $value;
            }
            $return[] = $row;
        }
        return $return;
    }
}
