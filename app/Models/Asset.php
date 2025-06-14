<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Lang;
use App\Helpers\ApplicationConstant;
use App\Casts\TimeCast;

class Asset extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'assets';
    protected $guarded = [];

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'branch_id' => 'required|exists:branches,id',
                'purchase_cd' => 'nullable|max:255',
                'asset_category' => 'required|in:'.implode(',', ApplicationConstant::ASSET_CATEGORY),
                'asset_name' => 'required|max:255',
                'initial_price' => 'required|integer|gt:0',
                'current_price' => 'required|integer|gt:0',
                'lifespan' => 'required|integer|gt:0',
                'purchase_dt' => 'nullable|date_format:Y-m-d',
                'desc' => 'nullable|max:1000',
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
            
            return $validator->getMessageBag()->add('asset_name', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'branch_id' => 'required|exists:branches,id',
                'asset_category' => 'required|in:'.implode(',', ApplicationConstant::ASSET_CATEGORY),
                'asset_name' => 'required|max:255',
                'initial_price' => 'required|integer|gt:0',
                'current_price' => 'required|integer|gt:0',
                'lifespan' => 'required|integer|gt:0',
                'asset_status' => 'required|in:'.implode(',', ApplicationConstant::ASSET_STATUS),
                'desc' => 'nullable|max:1000',
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
            return $validator->getMessageBag()->add('asset_name', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');
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
            'address',
            'url',
            'pics',
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
                $row[] = $value;
            }
            $return[] = $row;
        }
        return $return;
    }
}
