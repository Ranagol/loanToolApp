<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Tool;

$factory->define(Tool::class, function (Faker $faker) {
    return [
        'brand' => 'Makita',
        'model' => $faker->word,
        'description' => $faker->word,
        'serial_number' => $faker->numberBetween($min = 1000000, $max = 9000000),
        'price' => $faker->numberBetween($min = 1000, $max = 3000),
        'onStock' => true,
        'tool_picture_url' => 'https://si.makitamedia.com/images/1_Makita/101_machines/10108_PNG_Web/HR2653T.png',
        'comments' => $faker->realText(40),
    ];
});
