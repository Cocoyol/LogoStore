<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class PendingOrder extends Model
{
    protected $fillable = [
        'name', 'email', 'phone',

        'company', 'secondaryText', 'logo_id',
    ];

    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }

}
