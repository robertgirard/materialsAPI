<?php

use App\Models\Material as Material;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$suffix = [
    'Resin',
    'Surfactant',
    'Additive',
    'Rheology Modifier',
    'Microspheres',
    'Mineral Filler',
    'Hydrotrope',
    'Nonionic Surfactant',
    'Amphoteric Surfactant',
    'Chelating Agent',
    'Catalyst',
    'Corrision Inhibitor'
];


$factory->define(Material::class, function (Faker $faker) use($suffix) {

    return [

        'materialName' => $faker->word . ' ' . Arr::random($suffix),
        'description' => $faker->sentence,
        'manufacturer' => $faker->company,
//        'partNo' => $faker->numberBetween(1000, 10000),
        'specGrav' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0.5, $max = 2.0),
        'typeID' => $faker->numberBetween(1,4),
//        'units' => $faker->word,

    ];
    
});
