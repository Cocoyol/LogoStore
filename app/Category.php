<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function logos() {
        return $this->hasMany(Logo::class);
    }
}
