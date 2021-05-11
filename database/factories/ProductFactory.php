<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

$factory->define(Product::class, function (Faker $faker) {
    // $image = $faker->image('c:\Open_Servere\domains\lar-watch.loc\public\faker_image\products', 125, 200, null, false);
    // $imageFile = new File($image);
    return [
        'title' => $faker->words(2, true),
        'slug' => $faker->slug(3),
        'content' => $faker->paragraph(1),
        'price' => $faker->randomFloat(null, 0, 100),
        'status' => 1,
        'img' => $faker->imageUrl(125, 200),
        // 'img' => Storage::disk('public')->put('images', $imageFile), //->putFile('images', $imageFile),
        'category_id' => $faker->numberBetween(1, 14),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
