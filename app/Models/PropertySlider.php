<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image'
    ];

    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
    ];
}