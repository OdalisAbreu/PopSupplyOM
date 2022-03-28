<?php

use Illuminate\Database\Seeder;
use App\Directions;

class DirrectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Directions::create([
            'name' =>'Local',
            'description' => 'AV. prolongacion 27 de ebrero Colinas del Oeste # 15',
            'lat' => '18.459397265392433',
            'log' => '-69.98523056787853',
            'user_id' => '1'
        ]);
    }
}
