<?php

use Faker\Generator;
use LogoStore\Keyword;

class KeywordsTableSeeder extends BaseSeeder
{
    protected $total = 80;

    public function getModel()
    {
        return new Keyword();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => ucfirst($faker->randomLetter.$faker->unique()->word.$faker->randomLetter),
        ];
    }
}