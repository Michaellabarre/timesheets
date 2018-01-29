<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\User;
use App\Client;
use App\Job;
use App\Timesheet;
use App\Quote;
use App\Tasktype;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */

	//https://laravel-news.com/authorization-gates

	public function boot()
	{
		$this->registerPolicies();
		$this->registerUserPolicies();
		$this->registerClientPolicies();
		$this->registerJobPolicies();
		$this->registerTimesheetPolicies();
		$this->registerQuotePolicies();
		$this->registerReportPolicies();
		$this->registerTasktypePolicies();
	}
	public function registerUserPolicies(){
		Gate::define('create-user', function ($user) {
			return $user->inRole('administrator');
		});
		Gate::define('update-user', function ($user, User $user_row) {
	        return $user->inRole('administrator') or $user->id == $user_row->id;
	    });
	    Gate::define('delete-user', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('view-user', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('list-users', function ($user) {
	        return $user->inRole('administrator');
	    });
	}
	public function registerClientPolicies(){
		Gate::define('create-client', function ($user) {
			return $user->inRole('administrator');
		});
		Gate::define('update-client', function ($user, Client $client) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('delete-client', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('view-client', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('list-clients', function ($user) {
	        return $user->inRole('administrator');
	    });
	}
	public function registerJobPolicies(){
		Gate::define('create-job', function ($user) {
			return $user->inRole('administrator');
		});
		Gate::define('update-job', function ($user, Job $job) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('delete-job', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('view-job', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('list-jobs', function ($user) {
	        return $user->inRole('administrator');
	    });
	}
	public function registerTimesheetPolicies(){
		Gate::define('create-timesheet', function ($user) {
			return $user->hasAccess(['create-timesheet']);
		});
		Gate::define('update-timesheet', function ($user, Timesheet $timesheet) {
	        return $user->inRole('administrator') or $user->id == $timesheet->user_id;
	    });
	    Gate::define('delete-timesheet', function ($user, Timesheet $timesheet) {
	        return $user->inRole('administrator') or $user->id == $timesheet->user_id;
	    });
	    Gate::define('view-timesheet', function ($user, Timesheet $timesheet) {
	        return $user->inRole('administrator') or $user->id == $timesheet->user_id;
	    });
	    Gate::define('list-timesheets', function ($user) {
	        return $user->inRole('administrator') or $user->inRole('supplier');
	    });
	}
	public function registerQuotePolicies(){
		Gate::define('create-quote', function ($user) {
			return $user->inRole('administrator');
		});
		Gate::define('update-quote', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('delete-quote', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('view-quote', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('list-quotes', function ($user) {
	        return $user->inRole('administrator');
	    });
	}
	public function registerReportPolicies()
	{
		Gate::define('generate-reports', function ($user) {
			return $user->inRole('administrator');
		});
	}
	public function registerTasktypePolicies(){
		Gate::define('create-tasktype', function ($user) {
			return $user->inRole('administrator');
		});
		Gate::define('update-tasktype', function ($user, Tasktype $tasktype) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('delete-tasktype', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('view-tasktype', function ($user) {
	        return $user->inRole('administrator');
	    });
	    Gate::define('list-tasktypes', function ($user) {
	        return $user->inRole('administrator');
	    });
	}
}
