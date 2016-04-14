<?php

use Faker\Generator;
use LogoStore\KeywordLogo;

class KeywordLogosTableSeeder extends BaseSeeder
{
    protected $total = 160;

    public function getModel()
    {
        return new KeywordLogo();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'keyword_id'   => $this->getRandom('Keyword')->id,
            'logo_id' => $this->getRandom('Logo')->id,
        ];
    }
}