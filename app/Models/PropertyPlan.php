<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyPlan extends Model
{
    use HasFactory, TraitsForTranslation;

    protected $fillable = [
        'property_id',
        'title',
        'description',
        'image'
    ];

    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
    ];
}