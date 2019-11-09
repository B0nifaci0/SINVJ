<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuss')->insert([
            'name' =>  'Vendido',
            // 'shop_id' => 1,
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('statuss')->insert([
            'name' =>  'Existente',
            // 'shop_id' => 1,
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('statuss')->insert([
            'name' =>  'Traspaso',
            // 'shop_id' => 1,
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('statuss')->insert([
            'name' =>  'Dañado',
            // 'shop_id' => 1,
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
    }
}
