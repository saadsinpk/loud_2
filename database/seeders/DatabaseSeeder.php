<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            // PermissionssTableSeeder::class
             //  RolesTableSeeder::class,
          //  RolesTableSeeder::class,
          // PermissionTableSeeder::class,
            //UserLevelSeeder::class,
           
            //CreateAdminUserSeeder::class,
           // ElectionsTableSeeder::class,
           // StatesTableSeeder::class,
          //  TicketsTableSeeder::class,
          //  SenatorialDistrictsTableSeeder::class,
         //   LgasTableSeeder::class,
         //   FederalTableSeeder::class,
            PartiesTableSeeder::class
        ]);

    }
}
