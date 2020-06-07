<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city' => $faker->city,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'scan_doc' => 'https://blog.goranrakic.com/uploads/jfreesteelgui.png',
        'blacklist' => false,
        'comments' => $faker->realText(40),
    ];
});
