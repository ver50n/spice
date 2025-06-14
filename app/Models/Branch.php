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

class Branch extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'branches';
    protected $guarded = [];

    protected $casts = [
        'operation_start_time' => TimeCast::class,
        'operation_end_time' => TimeCast::class,
    ];

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required|max:255',
                'address' => 'required|max:1000',
                'phone' => 'required|numeric|digits_between:9,13',
                'map_url' => 'required|max:255',
                'operation_day' => 'required|max:1000',
                'operation_start_time' => 'required|date_format:H:i',
                'operation_end_time' => 'required|date_format:H:i',
                'annoucement' => 'nullable|max:1000',
                'note' => 'nullable|max:1000',
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
                'address' => 'required|max:1000',
                'phone' => 'required|numeric|digits_between:9,13',
                'map_url' => 'nullable|max:255',
                'operation_day' => 'required|max:1000',
                'operation_start_time' => 'required|date_format:H:i',
                'operation_end_time' => 'required|date_format:H:i',
                'annoucement' => 'nullable|max:1000',
                'note' => 'nullable|max:1000',
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
