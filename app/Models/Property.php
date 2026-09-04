<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, TraitsForTranslation;

    /* =========================================
       RELATIONS
    ==========================================*/
   // Property Type (Category)
    public function property_type()
    {
        return $this->belongsTo(Category::class, 'property_type_id');
    }
public function country()
{
    return $this->belongsTo(Country::class);
}

public function state()
{
    return $this->belongsTo(State::class);
}

public function city()
{
    return $this->belongsTo(City::class);
}
public function sliders()
{
    return $this->hasMany(PropertySlider::class, 'property_id');
}

public function plans()
{
    return $this->hasMany(PropertyPlan::class, 'property_id');
}

public function nearestLocations()
{
    return $this->hasMany(PropertyNearestLocation::class, 'property_id');
}

public function additionalInformations()
{
    return $this->hasMany(AdditionalInformation::class, 'property_id');
}
    // Sub Property Type
    public function subPropertyType()
    {
        return $this->belongsTo(SubPropertyType::class, 'sub_property_type_id');
    }

    // 🔥 Child Sub Property Type (NEW)
    public function childSubPropertyType()
    {
        return $this->belongsTo(ChildSubPropertyType::class, 'child_sub_property_type_id');
    }

    // Agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id')
            ->select('id', 'name', 'phone', 'email','designation','image', 'user_name');
    }

    // Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    // Amenities
  public function aminities()
{
    return $this->belongsToMany(
        Aminity::class,
        'property_aminities',   // ✅ correct table name
        'property_id',
        'aminity_id'
    );
}

    /* =========================================
       APPENDS
    ==========================================*/

    protected $appends = ['totalRating', 'ratingAvarage'];

    public function getTotalRatingAttribute()
    {
        return $this->reviews()->count();
    }

    public function getRatingAvarageAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    /* =========================================
       CASTS
    ==========================================*/

    protected $casts =  [
        'id' => 'integer',
        'agent_id' => 'integer',
        'property_type_id' => 'integer',
        'sub_property_type_id' => 'integer',
        'child_sub_property_type_id' => 'integer', // 🔥 NEW
        'city_id' => 'integer',
        'serial' => 'integer',
        'totalRating' => 'integer',
        'ratingAvarage' => 'double',
        'configuration_json' => 'array',
          'config_json' => 'array',
    ];
}