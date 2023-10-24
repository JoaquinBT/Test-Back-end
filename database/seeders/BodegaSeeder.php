<?php

namespace Database\Seeders;

use App\Models\Bodega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodegaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$data = [
            'nombre_bodega' => 'Bodega dos'
        ];
        Bodega::create($data);*/
        
        Bodega::insert([
            [
                'nombre_bodega' => 'Bodega uno',
            ],
            [
                'nombre_bodega' => 'Bodega dos',
            ],
            [
                'nombre_bodega' => 'Bodega tres',
            ],
            [
                'nombre_bodega' => 'Bodega cuatro',
            ],
        ]);
    }
}
