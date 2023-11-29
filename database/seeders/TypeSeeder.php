<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new Type;
        $type->id = '1';
        $type->name = 'prodazha';
        $type->timestamps = false;
        $type->save();

        $type = new Type;
        $type->id = '2';
        $type->name = 'arenda';
        $type->timestamps = false;
        $type->save();
    }
}
