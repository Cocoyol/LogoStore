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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keyword_logos')->withTimestamps();
    }
}
