<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubPropertyType extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function childSubTypes()
{
    return $this->hasMany(ChildSubPropertyType::class);
}
}