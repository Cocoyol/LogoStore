<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class RequirementsLogo extends Model
{
    protected $fillable = [
        'company', 'secondaryText', 'logo_id'
    ];

    public function logos()
    {
        return $this->belongsTo(Logo::class);
    }
}
