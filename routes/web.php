<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	 if (! Auth::check()) {
		return view('auth.login');
	 }
	 else{
		return view('home');
	 }
})->name('home');

Auth::routes();


Route::get('admin', 'AdminController@index')->name('admin.index');


//Route::resource('clients', 'ClientController');
//Route::resource('jobs', 'JobController');
Route::resource('contacts', 'ContactController');
//Route::resource('timesheets', 'TimesheetController');


//https://laravel-news.com/authorization-gates

Route::group(['prefix' => 'clients'], function () {
	Route::get('/', 'ClientController@index')->name('clients.index')->middleware('can:list-clients');
	Route::post('/', 'ClientController@store')->name('clients.store')->middleware('can:create-client');
	Route::get('/create', 'ClientController@create')->name('clients.create')->middleware('can:create-client');
	Route::delete('/{client}', 'ClientController@destroy')->name('clients.destroy')->middleware('can:delete-client,client');
	Route::patch('/{client}', 'ClientController@update')->name('clients.update')->middleware('can:update-client,client');
	Route::get('/{client}', 'ClientController@show')->name('clients.show')->middleware('can:view-client');
	Route::get('/{client}/edit', 'ClientController@edit')->name('clients.edit')->middleware('can:update-client,client');
});


Route::group(['prefix' => 'jobs'], function () {
	Route::get('/', 'JobController@index')->name('jobs.index')->middleware('can:list-jobs');
	Route::post('/', 'JobController@store')->name('jobs.store')->middleware('can:create-job');
	Route::get('/create', 'JobController@create')->name('jobs.create')->middleware('can:create-job');
	Route::delete('/{job}', 'JobController@destroy')->name('jobs.destroy')->middleware('can:delete-job,job');
	Route::patch('/{job}', 'JobController@update')->name('jobs.update')->middleware('can:update-job,job');
	Route::get('/{job}', 'JobController@show')->name('jobs.show')->middleware('can:view-job');
	Route::get('/{job}/edit', 'JobController@edit')->name('jobs.edit')->middleware('can:update-job,job');
});


Route::group(['prefix' => 'tasktypes'], function () {
	Route::get('/', 'TasktypeController@index')->name('tasktypes.index')->middleware('can:list-tasktypes');
	Route::post('/', 'TasktypeController@store')->name('tasktypes.store')->middleware('can:create-tasktype');
	Route::get('/create', 'TasktypeController@create')->name('tasktypes.create')->middleware('can:create-tasktype');
	Route::delete('/{tasktype}', 'TasktypeController@destroy')->name('tasktypes.destroy')->middleware('can:delete-tasktype,tasktype');
	Route::patch('/{tasktype}', 'TasktypeController@update')->name('tasktypes.update')->middleware('can:update-tasktype,tasktype');
	Route::get('/{tasktype}', 'TasktypeController@show')->name('tasktypes.show')->middleware('can:view-tasktype');
	Route::get('/{tasktype}/edit', 'TasktypeController@edit')->name('tasktypes.edit')->middleware('can:update-tasktype,tasktype');
});

Route::group(['prefix' => 'timesheets'], function () {
	Route::get('/', 'TimesheetController@index')->name('timesheets.index')->middleware('can:list-timesheets');
	Route::post('/', 'TimesheetController@store')->name('timesheets.store')->middleware('can:create-timesheet');
	Route::get('/create', 'TimesheetController@create')->name('timesheets.create')->middleware('can:create-timesheet');
	Route::delete('/{timesheet}', 'TimesheetController@destroy')->name('timesheets.destroy')->middleware('can:delete-timesheet,timesheet');
	Route::patch('/{timesheet}', 'TimesheetController@update')->name('timesheets.update')->middleware('can:update-timesheet,timesheet');
	Route::get('/{timesheet}', 'TimesheetController@show')->name('timesheets.show')->middleware('can:view-timesheet');
	Route::get('/{timesheet}/edit', 'TimesheetController@edit')->name('timesheets.edit')->middleware('can:update-timesheet,timesheet');
});

Route::group(['prefix' => 'users'], function () {
	Route::get('/', 'UserController@index')->name('users.index')->middleware('can:list-users');
	Route::post('/', 'UserController@store')->name('users.store')->middleware('can:create-user');
	Route::get('/create', 'UserController@create')->name('users.create')->middleware('can:create-user');
	Route::delete('/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:delete-user,user');
	Route::patch('/{user}', 'UserController@update')->name('users.update')->middleware('can:update-user,user');
	Route::get('/{user}', 'UserController@show')->name('users.show')->middleware('can:view-user');
	Route::get('/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:update-user,user');
});

Route::group(['prefix' => 'quotes'], function () {
	Route::get('/', 'QuoteController@index')->name('quotes.index')->middleware('can:list-quotes');
	Route::post('/', 'QuoteController@store')->name('quotes.store')->middleware('can:create-quote');
	Route::get('/create', 'QuoteController@create')->name('quotes.create')->middleware('can:create-quote');
	Route::delete('/{quote}', 'QuoteController@destroy')->name('quotes.destroy')->middleware('can:delete-quote');
	Route::patch('/{quote}', 'QuoteController@update')->name('quotes.update')->middleware('can:update-quote');
	//Route::get('/{quote}', 'QuoteController@show')->name('quotes.show')->middleware('can:view-quote');
	Route::get('/{quote}/edit', 'QuoteController@edit')->name('quotes.edit')->middleware('can:update-quote');
});

Route::group(['prefix' => 'reports'], function () {
	Route::get('/', 'ReportsController@index')->name('reports.index')->middleware('can:generate-reports');
	Route::get('/generate', 'ReportsController@generate')->name('reports.generate')->middleware('can:generate-reports');
	Route::post('/generate', 'ReportsController@generate')->name('reports.generate')->middleware('can:generate-reports');
	//Route::get('/', 'ReportsController@by_project')->name('reports.by_project')->middleware('can:generate-reports');
});
