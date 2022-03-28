<?php

use Illuminate\Database\Seeder;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        [
            'name' =>'Electronicos',
            'description' => 'Tienda de Electronicos',
            'image' => '61h1rI-AmqL._AC_SX522_.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ],
        [
            'name' =>'Ropas',
            'description' => 'Tienda de Ropas',
            'image' => '81uex-eHXpL._AC_UX522_.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ],
        [
            'name' =>'Comunicacion',
            'description' => 'Redes Sociales',
            'image' => 'redes.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]
        ]);
    }
}
