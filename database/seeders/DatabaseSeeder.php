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
            /* RolePermissionSeeder::class, // admin and permisiion and roles
           //  PermissionssTableSeeder::class
            // permissionsrolesTableSeeder::class,
             CreateAdminUserSeeder::class, // another admin
             UsersTableSeeder::class,
            
           
             
            ElectionsTableSeeder::class,
            StatesTableSeeder::class,
            TicketsTableSeeder::class,
            SenatorialDistrictsTableSeeder::class,
            LgasTableSeeder::class,
            FederalTableSeeder::class,
            PartiesTableSeeder::class*/

            LGAUpdateTableSeed::class,
            WardTsbleSeeder::class,
            PollingUnitsTableSeeder::class

        ]);

    }
}
