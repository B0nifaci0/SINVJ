<?php

use App\State;
use App\Municipality;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateTableSeeder::class);

        $this->command->info('State table seeded!');

        $this->call(MunicipalityTableSeeder::class);

        $this->command->info('Municipality table seeded!');
    }
}

