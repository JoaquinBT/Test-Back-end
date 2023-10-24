<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $data = [
            'nombre_marca' => 'Apple'
        ];
        Marca::create($data);*/
        Marca::insert([
            [
                'nombre_marca' => 'Samsung',
            ],
            [
                'nombre_marca' => 'Apple',
            ],
            [
                'nombre_marca' => 'Xiaomi',
            ],
            [
                'nombre_marca' => 'Huawei',
            ],
        ]);
    }
}
