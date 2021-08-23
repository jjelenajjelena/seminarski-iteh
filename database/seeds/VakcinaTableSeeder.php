<?php

use App\Vakcina;
use Illuminate\Database\Seeder;

class VakcinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Vakcina::insert([
                'proizvodjac' => 'Srbopharm',
                'drzava_porekla' => 'Srbija',
                'drzava_tag' => 'SRB',
            ]);
            Vakcina::insert([
                'proizvodjac' => 'Fajzer',
                'drzava_porekla' => 'Amerika',
                'drzava_tag' => 'USA',
            ]);
            Vakcina::insert([
                'proizvodjac' => 'Sputnik V',
                'drzava_porekla' => 'Rusija',
                'drzava_tag' => 'RUS',
            ]);

    }
}
