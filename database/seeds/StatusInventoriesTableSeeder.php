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
        DB::table('status_inventories')->insert([
            'name' =>  'Pendiente',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Existente',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Dañado',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Faltante',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Traspaso Pendiente',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Traspaso Aceptado',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('status_inventories')->insert([
            'name' =>  'Vendido',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
    }
}