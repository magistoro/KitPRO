<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function createSubcats(Category $cat, array $names ):array
        {
            $newCats = []; 
            foreach ($names as $key => $name){
                $newCat = $cat->children()->create([
                    'name' => $name,
                ]);
                $newCats[$key] = $newCat;
            }
            return $newCats;
        }

        $prodazha = Category::create([
            'name' => 'Продажа'
        ]);

        $arenda = Category::create([
            'name' => 'Аренда'
        ]);

        // ПРОДАЖА
        $names = [
            'Грип',
            'Звук',
            'Инструмент',
            'Свет',
            'Оборудование б/у'
        ];
        $prodazhaChildren = createSubcats($prodazha, $names);

        // ПРОДАЖА -> ГРИП и ЗВУК
        $grip = $prodazhaChildren[0];
        $sound = $prodazhaChildren[1];
        $names = [
            'Magic-arm',
            'Автополе'
        ];
        $gripChildren = createSubcats($grip, $names);
        $names = [
            'Бандажи',
            'Ветрозащиты'
        ];
        $soundChildren = createSubcats($sound, $names);

        $names = [
            'Аренда киносвета',
            'Аренда кинотранспорта',
        ];
        $arendaChildren = createSubcats($arenda, $names);
        $arenda_kinosveta = $arendaChildren[0];
        $names = ['ARRI M-series'];
        $arriChildren = createSubcats($arenda_kinosveta, $names);
        Category::fixTree();
    }
}
