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
        $this->call(UlogaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UstanovaTableSeeder::class);
        $this->call(VakcinaTableSeeder::class);
        $this->call(PrijavaTableSeeder::class);
    }
}
