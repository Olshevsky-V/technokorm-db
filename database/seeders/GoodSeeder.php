<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        \App\Models\Good::create([
            'name' => 'Ракушка морская кормовая для птицы',
            'categories' => [0, 3],
            'tags' => ['all', 'bird'],
            
            'image' => 'goods/sample/conch.jpg'
            ]);
        \App\Models\Good::create([
            'name' => 'ЗЦМ для телят',
            'categories' => [0, 5],
            'tags' => ['all', 'cattle'],
            
            'image' => 'goods/sample/wms.jpg'
            ]);
        \App\Models\Good::create([
            'name' => 'Премиксы для поросят',
            'categories' => [0, 6],
            'tags' => ['all', 'pig'],
            
            'image' => 'goods/sample/pig-premixes.jpg'
            ]);
    
    }
}
