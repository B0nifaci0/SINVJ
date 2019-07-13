<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'id' => '01',
            'name' =>  'Aguascalientes',
            'abbrev' =>  'Ags.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '02',
            'name' =>  'Baja California',
            'abbrev' =>  'BC',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '03',
            'name' =>  'Baja California Sur',
            'abbrev' =>  'BCS',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '04',
            'name' =>  'Campeche',
            'abbrev' =>  'Camp.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '05',
            'name' =>  'Coahuila de Zaragoza',
            'abbrev' =>  'Coah.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '06',
            'name' =>  'Colima',
            'abbrev' =>  'Col.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '07',
            'name' =>  'Chiapas',
            'abbrev' =>  'Chis.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '08',
            'name' =>  'Chihuahua',
            'abbrev' =>  'Chih.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '09',
            'name' =>  'Ciudad de México',
            'abbrev' =>  'CDMX',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '10',
            'name' =>  'Durango',
            'abbrev' =>  'Dgo.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '11',
            'name' =>  'Guanajuato',
            'abbrev' =>  'Gto.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '12',
            'name' =>  'Guerrero',
            'abbrev' =>  'Gro.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '13',
            'name' =>  'Hidalgo',
            'abbrev' =>  'Hgo.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '14',
            'name' =>  'Jalisco',
            'abbrev' =>  'Jal.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '15',
            'name' =>  'Estado de México',
            'abbrev' =>  'Mex.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '16',
            'name' =>  'Michoacán de Ocampo',
            'abbrev' =>  'Mich.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '17',
            'name' =>  'Morelos',
            'abbrev' =>  'Mor.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '18',
            'name' =>  'Nayarit',
            'abbrev' =>  'Nay.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '19',
            'name' =>  'Nuevo León',
            'abbrev' =>  'NL',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '20',
            'name' =>  'Oaxaca',
            'abbrev' =>  'Oax.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '21',
            'name' =>  'Puebla',
            'abbrev' =>  'Pue.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '22',
            'name' =>  'Querétaro',
            'abbrev' =>  'Qro.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '23',
            'name' =>  'Quintana Roo',
            'abbrev' =>  'Q. Roo',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '24',
            'name' =>  'San Luis Potosí',
            'abbrev' =>  'SLP',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '25',
            'name' =>  'Sinaloa',
            'abbrev' =>  'Sin.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '26',
            'name' =>  'Sonora',
            'abbrev' =>  'Son.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '27',
            'name' =>  'Tabasco',
            'abbrev' =>  'Tab.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '28',
            'name' =>  'Tamaulipas',
            'abbrev' =>  'Tamps.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '29',
            'name' =>  'Tlaxcala',
            'abbrev' =>  'Tlax.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '30',
            'name' =>  'Veracruz de Ignacio de la Llave',
            'abbrev' =>  'Ver.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '31',
            'name' =>  'Yucatán',
            'abbrev' =>  'Yuc.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
        DB::table('states')->insert([
            'id' => '32',
            'name' =>  'Zacatecas',
            'abbrev' =>  'Zac.',
            'country' =>  'MX',
            'created_at' => '2019-01-01 16:00:00',
            'updated_at' => '2019-01-01 16:00:00',
        ]);
    }
}
