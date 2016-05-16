<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'details',
        'status'
    ];

    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function requirements()
    {
        return $this->hasOne(RequirementsLogo::class);
    }

    public function additionalRequirements()
    {
        return $this->hasMany(AdditionalRequirementsLogo::class);
    }
}
