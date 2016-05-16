<?php

use Faker\Generator;
use LogoStore\RequirementsLogo;

class RequirementsLogosTableSeeder extends BaseSeeder
{
    protected $total = 40;

    public function getModel()
    {
        return new RequirementsLogo();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'company'   => $faker->unique()->company,
            'secondaryText'  => $faker->text(40),
            'order_id'  => $this->getRandomUnique('Order')->id,
        ];
    }
}