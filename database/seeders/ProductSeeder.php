<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\module_coffe_store\product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reference = [
            '250ml', 
            '500ml', 
            '600ml', 
            '1l', 
            '1.5l', 
            'und[s]', 
            'libra[s]', 
            'kilo[s]'
        ];

        $category = [
            'bebidas', 
            'panadería', 
            'pastelería', 
            'postres', 
            'tortas'
        ];

        $rows =
        [
            [
                'name' => trim(strtolower('acemas')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 600,
                'stock' => 200,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('pan queso')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 800,
                'stock' => 250,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('buñuelos')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 900,
                'stock' => 50,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('pandebono')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 60,
                'stock' => 200,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('pan integral mediano')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 1200,
                'stock' => 20,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('pan integral grande')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 3000,
                'stock' => 10,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('pan con pasas')),
                'reference' => trim(strtolower('und[s]')),
                'price' => 1500,
                'stock' => 15,
                'category' => trim(strtolower('panadería'))
            ],

            [
                'name' => trim(strtolower('postre de tres leches')),
                'reference' => trim(strtolower('libra[s]')),
                'price' => 35000,
                'stock' => 30,
                'category' => trim(strtolower('postres'))
            ],

            [
                'name' => trim(strtolower('postre nutelloti')),
                'reference' => trim(strtolower('libra[s]')),
                'price' => 60200,
                'stock' => 30,
                'category' => trim(strtolower('postres'))
            ],

            [
                'name' => trim(strtolower('tarta de limon mediana')),
                'reference' => trim(strtolower('libra[s]')),
                'price' => 7500,
                'stock' => 18,
                'category' => trim(strtolower('tortas'))
            ],

            [
                'name' => trim(strtolower('tarta de limon grande')),
                'reference' => trim(strtolower('kilo[s]')),
                'price' => 24600,
                'stock' => 8,
                'category' => trim(strtolower('tortas'))
            ],

            [
                'name' => trim(strtolower('tarta de banano')),
                'reference' => trim(strtolower('kilo[s]')),
                'price' => 44600,
                'stock' => 13,
                'category' => trim(strtolower('tortas'))
            ],

            [
                'name' => trim(strtolower('hit caja personal naranja')),
                'reference' => trim(strtolower('250ml')),
                'price' => 2400,
                'stock' => 13,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('hit caja personal mora')),
                'reference' => trim(strtolower('250ml')),
                'price' => 2400,
                'stock' => 11,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('hit caja personal mango')),
                'reference' => trim(strtolower('250ml')),
                'price' => 2400,
                'stock' => 3,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('postobon manzana')),
                'reference' => trim(strtolower('1.5l')),
                'price' => 3600,
                'stock' => 23,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('coca cola')),
                'reference' => trim(strtolower('1.5l')),
                'price' => 4600,
                'stock' => 33,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('cafe tasa')),
                'reference' => trim(strtolower('250ml')),
                'price' => 1800,
                'stock' => 60,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('cafe con leche tasa')),
                'reference' => trim(strtolower('250ml')),
                'price' => 2600,
                'stock' => 60,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('cafe con leche tasa')),
                'reference' => trim(strtolower('500ml')),
                'price' => 4600,
                'stock' => 60,
                'category' => trim(strtolower('bebidas'))
            ],

            [
                'name' => trim(strtolower('cafe tasa')),
                'reference' => trim(strtolower('500ml')),
                'price' => 3200,
                'stock' => 60,
                'category' => trim(strtolower('bebidas'))
            ]
        ];

        foreach($rows as $row){
            $product = product::create($row);
        }


    }
}
