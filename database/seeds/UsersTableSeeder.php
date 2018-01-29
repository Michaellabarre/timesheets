<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    	
        $faker = Faker\Factory::create();

        for($i = 0; $i < 5; $i++){
            $user = new \App\User;
            $user->name = $faker->name;
            $user->email = $faker->unique()->safeEmail;
            $user->password = bcrypt('password');
            $user->remember_token = str_random(10);     
            $user->save();
            $user->roles()->attach($faker->numberBetween(1,2));
        }    	
    }
}
