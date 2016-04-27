<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class ImagesLogo extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function logos()
    {
        return $this->belongsTo(Logo::class);
    }
}
