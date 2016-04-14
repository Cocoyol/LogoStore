<?php

use Faker\Generator;
use LogoStore\Order;

class OrdersTableSeeder extends BaseSeeder
{
    protected $total = 40;

    public function getModel()
    {
        return new Order();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'details'   => $faker->paragraph(),
            'logo_id'  => $this->getRandomUnique('Logo')->id,
            'customer_id'  => $this->getRandom('Customer')->id,
        ];
    }
}