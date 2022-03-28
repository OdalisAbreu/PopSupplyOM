<?php

use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('product_images')->insert([
            [
                'image' =>'61h1rI-AmqL._AC_SX522_.jpg',
                'featured' => '0',
                'product_id' => '1'
            ],
            [
                'image' =>'61ltL1MWALL._AC_SX522_.jpg',
                'featured' => '0',
                'product_id' => '2'
            ],
            [
                'image' =>'81TQ253GUBL._AC_SY450_.jpg',
                'featured' => '0',
                'product_id' => '3'
            ],
            [
                'image' =>'81uex-eHXpL._AC_UX522_.jpg',
                'featured' => '0',
                'product_id' => '4'
            ],
            [
                'image' =>'41Bv1q19L_AC_UX569_.jpg',
                'featured' => '0',
                'product_id' => '5'
            ],
            [
                'image' =>'51O1T93EBL_AC_UX425_.jpg',
                'featured' => '0',
                'product_id' => '6'
            ],
            [
                'image' =>'Facebook.jpg',
                'featured' => '0',
                'product_id' => '7'
            ],
            [
                'image' =>'Instagram.png',
                'featured' => '0',
                'product_id' => '8'
            ],
            [
                'image' =>'WhatApp.jpg',
                'featured' => '0',
                'product_id' => '9'
            ]
            ]);
        }
    }
}
