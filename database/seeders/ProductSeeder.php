<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            8 => ['Держатель Manfrotto Magic Arm VARIABLE FRICTION ARM W/BRACKET', 'Держатель Noga Magic Arm MINI 140mm 1/4" - 1/4"', 'Держатель Manfrotto Magic Arm ALONE W/O ACCES'],
            9 => ['Удлинитель автополя KUPO Extension tube (2m) - Polish'],
            10 => ['Бандаж для крепления микрофона на голень URSA', 'Бандаж для крепления микрофона на грудь URSA'],
            11 => ['Ветрозащита Rycote для ZOOM H4N', 'Ветрозащита URSA FOAMIES (12 шт/уп)'],
            13 => ['Аренда худвагена длиной 6м с гидробортом', 'Аренда актёрского вагона'],
            14 => ['Аренда осветительного прибора ARRI M8', 'Аренда осветительного прибора ARRI M90'],
        ];

        foreach ($categories as $namesArrayKey => $namesArray)
        {
            foreach ($namesArray as $name) {
                Product::factory()->state([
                        'name' => $name,
                        'category_id' => $namesArrayKey,
                    ]
                )->create();
            }
        }


        
    }
}
