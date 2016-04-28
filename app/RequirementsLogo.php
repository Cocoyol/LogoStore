<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class RequirementsLogo extends Model
{
    protected $fillable = [
        'company', 'secondaryText', 'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
