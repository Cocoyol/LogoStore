<?php

namespace LogoStore\Http\Controllers\Admin;

use LogoStore\Http\Controllers\Controller;
use LogoStore\Keyword;
use LogoStore\Logo;

class KeywordLogoController extends Controller
{
    public function multiStore(Logo $logo, array $keywords_id)
    {
        foreach($keywords_id as $keyword_id) {
            $keyword = Keyword::findOrFail($keyword_id);
            $this->store($logo, $keyword->id);
        }
        return true;
    }

    public function store(Logo $logo, $keyword_id)
    {
        if($logo->getKeyword($keyword_id)) return false;

        $logo->keywords()->attach($keyword_id);
        return true;
    }
}