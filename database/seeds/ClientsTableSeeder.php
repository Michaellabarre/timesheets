<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Client::class, 10)->create()->each(
			function($client)
            {
				$client->contacts()->saveMany( factory(App\Contact::class, 2)->make() );

                $client->jobs()->saveMany( factory(App\Job::class, 5)->create(['client_id' => $client->id])->each(
                    function($job)
                    {
                        $job->timesheets()->saveMany( factory(App\Timesheet::class, 10)->create( [ 'job_id' => $job->id ] ) );
                        $job->quote()->save( factory(App\Quote::class)->create( [ 'job_id' => $job->id ] ) );
                    }
                ));

			}
		);
    }
}
