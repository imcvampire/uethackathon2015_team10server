<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' 				=> $faker->name,
        'email' 			=> $faker->email,
        'skype'				=> $faker->username,
        'disqus'			=> $faker->username,
        'score'				=> $faker->numberBetween(10, 1000),
        'avatar'			=> $faker->url,
        'password' 			=> bcrypt(str_random(10)),
        'remember_token' 	=> str_random(10),
    ];
});

$factory->define(App\Subject::class, function (Faker\Generator $faker) {
	return [
		'name'			=> $faker->name,
		'creator_id'	=> $faker->numberBetween(1, 2),
		'totalSearch'	=> $faker->numberBetween(10, 1000)
	];
});

$factory->define(App\Book::class, function(Faker\Generator $faker) {
	return [
		'name'			=> $faker->streetName,
		'author'		=> $faker->name,
		'publisher'		=> $faker->city,
		'intro'			=> $faker->sentence,
		'likes'			=> $faker->numberBetween(1, 100),
		'selected'		=> $faker->numberBetween(1, 50),
		'creator_id'	=> $faker->numberBetween(1, 2),
		'subject_id'	=> $faker->numberBetween(1, 2),
	];
});

$factory->define(App\Website::class, function(Faker\Generator $faker) {
	return [
		'link'			=> $faker->url,
		'name'			=> $faker->company,
		'intro'			=> $faker->sentence,
		'creator_id'	=> $faker->numberBetween(1, 2),
		'subject_id'	=> $faker->numberBetween(1, 2),
		'likes'			=> $faker->numberBetween(1, 100),
		'selected'		=> $faker->numberBetween(1, 50),
	];
});

$factory->define(App\Person::class, function(Faker\Generator $faker) {
	return [
		'link'			=> $faker->url,
		'name'			=> $faker->name,
		'intro'			=> $faker->sentence,
		'creator_id'	=> $faker->numberBetween(1, 2),
		'subject_id'	=> $faker->numberBetween(1, 2),
		'likes'			=> $faker->numberBetween(1, 100),
		'selected'		=> $faker->numberBetween(1, 50),
	];
});