<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	 use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }

   public function testAddUser()
    {
    	//add user
    	$user =  User::create([
    	    'name' => 'Username2',
    	    'email' => 'sally@example.com',
    	    'password' => bcrypt('password'),
    	]);
    	$this->assertDatabaseHas('users', [
	        'email' => 'sally@example.com',
	        'name' => 'Username2',
	    ]);
    }

    public function testDeleteUser()
    {
    	//add user
    	$user =  User::create([
    	    'name' => 'Username',
    	    'email' => 'sally@example.com',
    	    'password' => bcrypt('password'),
    	]);
    	$this->assertDatabaseHas('users', [
            'email' => 'sally@example.com',
            'name' => 'Username',
        ]);
        User::destroy($user->id);
    	$this->assertDatabaseMissing('users', [
	        'email' => 'sally@example.com',
	        'name' => 'Username',
	    ]);
    } 

    public function testUpdateUser()
    {
    	//add user
    	$user =  User::create([
    	    'name' => 'Username',
    	    'email' => 'sally@example.com',
    	    'password' => bcrypt('password'),
    	]);

    	$user->name = 'Edited';
    	$user->email = 'Edited@example.com';
    	$user->save();
    	$this->assertDatabaseMissing('users', [
	        'email' => 'sally@example.com',
	        'name' => 'Username',
	    ]);
	    $this->assertDatabaseHas('users', [
	        'email' => 'Edited@example.com',
	        'name' => 'Edited',
	    ]);

    }
}
