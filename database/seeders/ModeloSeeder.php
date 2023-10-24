<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$data = [
            'nombre_modelo' => 'IPhone 15 pro max',
            'marca_id'=> 2,
        ];
        Modelo::create($data);*/
        Modelo::insert([
            [
                'nombre_modelo' => 'Samsung galaxy s23',
                'marca_id'=> 1,
            ],
            [
                'nombre_modelo' => 'Samsung galaxy s22',
                'marca_id'=> 1,
            ],
            [
                'nombre_modelo' => 'Iphone 15 pro max',
                'marca_id'=> 2,
            ],
            [
                'nombre_modelo' => 'Xiaomi redmi note 12',
                'marca_id'=> 3,
            ],
            [
                'nombre_modelo' => 'Huawei p50',
                'marca_id'=> 4,
            ],
        ]);
    }
}
