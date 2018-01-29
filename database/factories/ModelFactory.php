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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
        // 'client_id' => function () {
        //     return factory(App\Client::class)->create()->id;
        // },
        'code' => strtoupper($faker->bothify('???#####')),
        'name' => $faker->bs,
        'active' => $faker->boolean(50),
    ];
});

$factory->define(App\Quote::class, function (Faker\Generator $faker) {
    return [
        // 'client_id' => function () {
        //     return factory(App\Client::class)->create()->id;
        // },

       /* 'pm_hours' => $faker->numberBetween(10,40),
        'dev_hours' => $faker->numberBetween(10,40),
        'design_hours' => $faker->numberBetween(10,40),*/
        
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'job_title' => $faker->jobTitle,
        'phone_number' => $faker->phoneNumber,
    ];
});

$factory->define(App\Timesheet::class, function (Faker\Generator $faker) {
    $user = App\User::inRandomOrder()->first();
    $tasktype = App\Tasktype::inRandomOrder()->first();


    //dd($user);

    return [
        'user_id' => $user->id,
        'date' => $faker->dateTimeThisMonth,
        'description' => $faker->sentence,
        'tasktype_id' => $tasktype->id,
        'hours' => $faker->randomDigitNotNull,
    ];
});
