<?php

use Faker\Generator;
use LogoStore\User;

class UsersTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new User();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password'  => bcrypt('secret'),
        ];
    }

    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(2);
    }

    private function createAdmin()
    {
        $this->create([
            'name' => 'Memo Memínez',
            'email' => 'memo@mail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}