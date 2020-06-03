<?php

use Faker\Generator;
use VCComponent\Laravel\SEO\Test\Stubs\Entities\Test;

$factory->define(Test::class, function (Generator $faker) {
    return [
        'name'        => 'test name',
        'description' => 'test description',
    ];
});
