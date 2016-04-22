<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class ImagesLogo extends Model
{
    protected $fillable = [
        'name', 'description', 'path', 'logo_id'
    ];

    public function logos()
    {
        return $this->belongsTo(Logo::class);
    }
}
