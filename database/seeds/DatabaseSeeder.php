<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatesTableSeeder::class,
            MunicipalitiesTableSeeder::class,
            ShopGroupsTableSeeder::class,
            ShopsTableSeeder::class,
            BranchesTableSeeder::class,
            UsersTableSeeder::class,
            StatusTableSeeder::class,
        ]);
    }
}
