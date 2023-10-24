<?php

namespace Database\Seeders;

use App\Models\Dispositivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DispositivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$data = [
            'nombre_dispositivo' => 'dispositivo de apple',
            'bodega_id'=> 2,
            'modelo_id'=> 1
        ];
        Dispositivo::create($data);*/
        Dispositivo::insert([
            //bodega 1
            [
                'nombre_dispositivo' => ' Dispositivo samsung galaxy s23',
                'bodega_id'=> 1,
                'modelo_id'=> 1
            ],
            [
                'nombre_dispositivo' => 'Dispositivo samsung galaxy s22',
                'bodega_id'=> 1,
                'modelo_id'=> 2 
            ],
            [
                'nombre_dispositivo' => 'Dispositivo iphone 15 pro max',
                'bodega_id'=> 1,
                'modelo_id'=> 3
            ],
            [
                'nombre_dispositivo' => 'Dispositivo xiaomi redmi note 12',
                'bodega_id'=> 1,
                'modelo_id'=> 4
            ],
            [
                'nombre_dispositivo' => 'Dispositivo Huawei p50',
                'bodega_id'=> 1,
                'modelo_id'=> 5 
            ],
            //bodega 2
            [
                'nombre_dispositivo' => 'Dispositivo iphone 15 pro max',
                'bodega_id'=> 2,
                'modelo_id'=> 3
            ],
            [
                'nombre_dispositivo' => 'Dispositivo dos iphone 15 pro max',
                'bodega_id'=> 2,
                'modelo_id'=> 3
            ],
            [
                'nombre_dispositivo' => 'Dispositivo samsung galaxy s23',
                'bodega_id'=> 2,
                'modelo_id'=> 1
            ],
            [
                'nombre_dispositivo' => 'Dispositivo xiaomi redmi note 12',
                'bodega_id'=> 2,
                'modelo_id'=> 4
            ],
            [
                'nombre_dispositivo' => 'Dispositivo Huawei p50',
                'bodega_id'=> 2,
                'modelo_id'=> 5
            ],
            //bodega 3
            [
                'nombre_dispositivo' => 'Dispositivo Huawei p50',
                'bodega_id'=> 3,
                'modelo_id'=> 5
            ],
            [
                'nombre_dispositivo' => 'Dispositivo dos Huawei p50',
                'bodega_id'=> 3,
                'modelo_id'=> 5
            ],
            [
                'nombre_dispositivo' => 'Dispositivo xiaomi redmi note 12',
                'bodega_id'=> 3,
                'modelo_id'=> 4
            ],
            [
                'nombre_dispositivo' => 'Dispositivo dos xiaomi redmi note 12',
                'bodega_id'=> 3,
                'modelo_id'=> 4
            ],
            [
                'nombre_dispositivo' => 'Dispositivo samsung galaxy s22',
                'bodega_id'=> 3,
                'modelo_id'=> 2 
            ],

        ]);
    }
}
