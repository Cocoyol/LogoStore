<?php

use Faker\Generator;
use LogoStore\Logo;

class LogosTableSeeder extends BaseSeeder
{
    protected $total = 60;

    public function getModel()
    {
        return new Logo();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->word,
            'code'   => str_random(),
            'date'  => $faker->dateTimeBetween('-1 years'),
            'description' => $faker->paragraph(),
            'price' => $faker->numberBetween(300, 1500),
            'status' => $faker->randomElement(['disponible', 'vendido']),

            'category_id' => $this->getRandom('Category')->id

        ];
    }
}