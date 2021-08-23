<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $ulogaId = rand(1, 2);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('test'), // password
        'jmbg' => generisiJmbg(),
        'uloga_id' => $ulogaId,
        'ustanova_id' => $ulogaId === 2 ? rand(1, 3) : null,
        'vakcina_id' => $ulogaId === 2 ? rand(1, 3) : null,
        'remember_token' => Str::random(10),
    ];
});

function generisiJmbg()
{
    $jmbg = '';
    for ($i = 0; $i < 13; $i++) {
        $jmbg .= rand(0, 9);
    }
    return $jmbg;
}
