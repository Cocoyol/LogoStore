<?php

use Faker\Generator;
use LogoStore\Customer;

class CustomersTableSeeder extends BaseSeeder
{
    protected $total = 25;

    public function getModel()
    {
        return new Customer();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->name,
            'email'  => $faker->email,
            'phone'  => $faker->phoneNumber,
        ];
    }
}