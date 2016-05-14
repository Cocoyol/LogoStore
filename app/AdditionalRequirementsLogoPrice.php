<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class AdditionalRequirementsLogoPrice extends Model
{
    protected $fillable = [
        'text', 'price'
    ];
}
