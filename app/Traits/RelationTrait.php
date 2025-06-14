<?php

namespace App\Traits;

trait RelationTrait
{
    // System Relation
    public function event()
    {
        return $this->belongsTo(\App\Models\Event::Class, 'event_id', 'id');
    }
    
    // Language Relation
}