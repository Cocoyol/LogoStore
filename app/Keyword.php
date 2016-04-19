<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'name',
    ];

    public function logos() {
        return $this->belongsToMany(Logo::class, 'keyword_logos')->withTimestamps();
    }
}
