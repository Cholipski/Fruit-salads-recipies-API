<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FruitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get(resource_path() . '/json/fruits.json');
        $fruits = json_decode($file, true);

        foreach ($fruits as $fruit)
        {
            Fruit::create([
                'name' => $fruit['name'],
                'carbohydrates' => $fruit['nutrients']['carbohydrates'],
                'protein' => $fruit['nutrients']['protein'],
                'fat' => $fruit['nutrients']['fat'],
                'calories' => $fruit['nutrients']['calories'],
                'sugar' => $fruit['nutrients']['sugar'],
            ]);
        }
    }
}
