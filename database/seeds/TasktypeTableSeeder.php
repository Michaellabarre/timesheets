<?php

use Illuminate\Database\Seeder;

class TasktypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(['Design', 'Development', 'Project Management'] as $name){
	        $tasktype = new \App\Tasktype;
	        $tasktype->name = $name;
	        $tasktype->save();
	    }
    }
}
