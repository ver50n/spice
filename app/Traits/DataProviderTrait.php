<?php

namespace App\Traits;

trait DataProviderTrait
{
    
    public function filterId($dp, $filters)
    {
        if(isset($filters['id']) && $filters['id'] != "")
            $dp = $dp->where($this->table.'.id', $filters['id']);
        return $dp;
    }

    public function filterIsActive($dp, $filters)
    {
        if(isset($filters['is_active']) && $filters['is_active'] != "")
            $dp = $dp->where($this->table.'.is_active', $filters['is_active']);
        return $dp;
    }

    public function filterByConducted($dp, $filters)
    {
        $dp = $dp->leftJoin('request_services', 'request_services.request_code', $this->table.'.request_code');
        
        if(isset($filters['status']) && $filters['status'] != "")
            $dp = $dp->where("request_services.status", $filters['status']);
        if(isset($filters['conducted_at']) && $filters['conducted_at'] != "")
            $dp = $dp->where('conducted_at', $filters['conducted_at']);
        if(isset($filters['conducted_in']) && $filters['conducted_in'] != "")
            $dp = $dp->where('conducted_in', 'LIKE', '%'.$filters['conducted_in'].'%');
        if(isset($filters['event_id']) && $filters['event_id'] != "")
            $dp = $dp->where('event_id', $filters['event_id']);

        return $dp;
    }

    public function filterCreatedAt($dp, $filters)
    {
        if((!empty($filters['created_at_start']) && $filters['created_at_start'] !== '')
            || (!empty($filters['created_at_end']) && $filters['created_at_end'] !== '')) {
            if((!empty($filters['created_at_start']) && $filters['created_at_start'] !== '')
                && (!empty($filters['created_at_end']) && $filters['created_at_end'] !== '')) {
                $dp = $dp->whereBetween($this->table.'.created_at', [$filters['created_at_start'], $filters['created_at_end']]);
            } else if ((!empty($filters['created_at_start']) && $filters['created_at_start'] !== '')
                && (empty($filters['created_at_end']) && $filters['created_at_end'] == '')) {
                $dp = $this->where($this->table.'.created_at', '>=', $filters['created_at_start']);
            } else if ((empty($filters['created_at_start']) && $filters['created_at_start'] == '')
                && (!empty($filters['created_at_end']) && $filters['created_at_end'] !== '')) {
                $dp = $dp->where($this->table.'.created_at', '<=', $filters['created_at_end']);
            }
        }
        return $dp;
    }

    public function filterUpdatedAt($dp, $filters)
    {
        if((!empty($filters['updated_at_start']) && $filters['updated_at_start'] !== '')
            || (!empty($filters['updated_at_end']) && $filters['updated_at_end'] !== '')) {
            if((!empty($filters['updated_at_start']) && $filters['updated_at_start'] !== '')
                && (!empty($filters['updated_at_end']) && $filters['updated_at_end'] !== '')) {
                $dp = $dp->whereBetween($this->table.'.updated_at', [$filters['updated_at_start'], $filters['updated_at_end']]);
            } else if ((!empty($filters['updated_at_start']) && $filters['updated_at_start'] !== '')
                && (empty($filters['updated_at_end']) && $filters['updated_at_end'] == '')) {
                $dp = $dp->where($this->table.'.updated_at', '>=', $filters['updated_at_start']);
            } else if ((empty($filters['updated_at_start']) && $filters['updated_at_start'] == '')
                && (!empty($filters['updated_at_end']) && $filters['updated_at_end'] !== '')) {
                $dp = $dp->where($this->table.'.updated_at', '<=', $filters['updated_at_end']);
            }
        }
        return $dp;
    }


    public function sortBy($dp, $options)
    {
        $name = isset($options['sort']['sort_name']) ? $options['sort']['sort_name'] : 'created_at';
        $type = isset($options['sort']['sort_type']) ? $options['sort']['sort_type'] : 'DESC';

        if(!\Schema::hasColumn($this->getTable(), $name))
            return $dp;

        $dp = $dp->orderBy($name, $type);

        return $dp;
    }

    public function retrieve($dp, $options)
    {
        if(isset($options['pagination']) && $options['pagination']) {
            $rowPerPage = isset($options['limit']) ? $options['limit'] : (\Session::get('rowPerPage') ? \Session::get('rowPerPage') : 30) ;
            
            $page = isset($options['page']) ? $options['page'] : 1;
            
            $dp = $dp->Paginate($rowPerPage, ['*'], 'page', $page);
        } else {
            $dp = $dp->get();
        }

        return $dp;
    }
}