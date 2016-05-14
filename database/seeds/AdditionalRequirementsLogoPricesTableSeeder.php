<?php

use LogoStore\AdditionalRequirementsLogoPrice;

class AdditionalRequirementsLogoPricesTableSeeder extends BaseSeeder
{
    protected $total = 40;

    public function getModel()
    {
        return new AdditionalRequirementsLogoPrice();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'text' => '',
            'price' => 150
        ];
    }

    public function run()
    {
        $this->create([
            'text' => 'Quiero cambar la tipograf&iacute;a (fuente)',
            'price' => 150
        ]);
        $this->create([
                'text' => 'Quiero cambar los colores',
                'price' => 150
        ]);
        $this->create([
                'text' => 'Quiero agregar revisiones al logotipo',
                'price' => 150
        ]);
    }
}