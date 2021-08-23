<?php

use App\Ustanova;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UstanovaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Ustanova::insert([
                'adresa' => 'Beograd',
                'naziv_ustanova' => 'Hala Sajam',
            ]);
            Ustanova::insert([
                'adresa' => 'Beograd',
                'naziv_ustanova' => 'Belekspo centar',
            ]);
            Ustanova::insert([
                'adresa' => 'Kragujevac',
                'naziv_ustanova' => 'Hala "Gordana Goca Bogojevic"',
            ]);
    }
}
