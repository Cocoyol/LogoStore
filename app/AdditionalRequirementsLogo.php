<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class AdditionalRequirementsLogo extends Model
{
    public function additionalRequirementsPrice()
    {
        return $this->belongsTo(AdditionalRequirementsLogoPrice::class, 'additional_requirements_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
