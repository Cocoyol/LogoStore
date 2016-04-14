<?php

use Faker\Generator;
use LogoStore\Category;

class CategoriesTableSeeder extends BaseSeeder
{
    protected $total = 30;

    public function getModel()
    {
        return new Category();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => ucfirst($faker->randomLetter.$faker->unique()->word.$faker->randomLetter),
        ];
    }
}