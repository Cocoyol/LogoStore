<?php

namespace LogoStore;

use Illuminate\Database\Eloquent\Model;

class KeywordLogo extends Model
{
    public function keywords()
    {
        return $this->belongsTo(Keyword::class);
    }

    public function logos()
    {
        return $this->belongsTo(Logo::class);
    }
}
