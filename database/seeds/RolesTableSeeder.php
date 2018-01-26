<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$author = App\Role::create([
    		'name' => 'Administrator', 
    		'slug' => 'administrator',
    		'permissions' => [
    			//all user permissions
    			'create-user' => true,
    			'update-user' => true,
                'delete-user' => true,
    			//all client permissions
    			'create-client' => true,
    			'update-client' => true,
    			'delete-client' => true,
    			//all job permissions
    			'create-job' => true,
    			'update-job' => true,
    			'delete-job' => true,
    			//all timesheet permissions
    			'create-timesheet' => true,
    			'update-timesheet' => true,
    			'delete-timesheet' => true,
    			//all quote permissions
    			'create-quote' => true,
    			'update-quote' => true,
    			'delete-quote' => true,
    		]
    	]);
    	$editor = App\Role::create([
    		'name' => 'Supplier', 
    		'slug' => 'supplier',
    		'permissions' => [
    			//edit own user account
    			'update-user' => true,
    			//create timesheets
    			'create-timesheet' => true,
    			//update own timesheets
    			'update-timesheet' => true,
    			//delete own timesheets
    			'delete-timesheet' => true,
    		]
    	]);
    }
}
