<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildSubPropertyType extends Model
{
    protected $fillable = [
        'sub_property_type_id',
        'name',
        'slug',
        'status'
    ];

    public function subPropertyType()
    {
        return $this->belongsTo(SubPropertyType::class);
    }
}