<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
        'name',
        'code',
        'date',
        'description',
        'price',
        'status',
        'category_id',
    ];
}
