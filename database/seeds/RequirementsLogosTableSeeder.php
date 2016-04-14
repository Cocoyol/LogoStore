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
            'secondaryText'  => $faker->paragraph(),
            'logo_id'  => $this->getRandomUnique('Order')->logo_id,
        ];
    }
}