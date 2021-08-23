<?php

use App\Uloga;
use Illuminate\Database\Seeder;

class UlogaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Uloga::insert([
            'naziv' => 'pacijent',
        ]);
        Uloga::insert([
            'naziv' => 'doktor',
        ]);
    }
}
