<?php

use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(\App\Product::class, function (Faker $faker) use ($autoIncrement) {
  $autoIncrement->next();
  return [
    'name' => 'Product ' . $autoIncrement->current(),
    'price' => rand(1, 100) . '000',
    'description' => 'Lorem ipsum sit dolor amet.',
    'condition' => 'New',
    'stock' => rand(1, 100),
  ];
});

function autoIncrement()
{
  for ($i = 0; $i < 1000; $i++) {
    yield $i;
  }
}