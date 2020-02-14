<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\client;
use Faker\Generator as Faker;

$factory->define(client::class, function (Faker $faker) {

    return [
        'prenom' => $faker->word,
        'nom' => $faker->word,
        'adresse' => $faker->word,
        'email' => $faker->word,
        'telephone' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
