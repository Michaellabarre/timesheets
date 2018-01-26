<?php

namespace App\Http\Controllers;

use App\Timesheet;
use App\Job;
use App\User;
use App\Tasktype;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        //dd($user);
        if($user->inRole('administrator')){
            $timesheets = Timesheet::paginate(15);
        } else {
            $timesheets = Timesheet::where('user_id',$user->id)->paginate(15);
        }
        return view('timesheets.index', compact('timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$clients = Client::pluck('name', 'id');
        $user = \Auth::user();
        $users = User::pluck('name', 'id');
        //$jobs = Job::pluck('code_name', 'id');
        $jobs = Job::select(
                    \DB::raw("CONCAT(code,' - ',name) AS codename"),'id')
                    ->pluck('codename', 'id');

        $tasktypes = Tasktype::pluck('name', 'id');

        return view('timesheets.create', compact('user', 'users', 'jobs', 'tasktypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $user = \App\User::findOrFail($request->input('user_id'));


        $posted_sheets = $request->input('timesheet');
        $count = count($posted_sheets['date']);
        for($i = 0; $i<$count; $i++){
            $timesheet = new Timesheet;
            
            //associate with related entities
            $tasktype = \App\Tasktype::findOrFail($posted_sheets['tasktype_id'][$i]);
            $job = \App\Job::findOrFail($posted_sheets['job_id'][$i]);

            $timesheet->user()->associate($user);
            $timesheet->tasktype()->associate($tasktype);            
            $timesheet->job()->associate($job);

            $timesheet->date = $posted_sheets['date'][$i];
            $timesheet->description = $posted_sheets['description'][$i];
            $timesheet->hours = $posted_sheets['hours'][$i];

            $timesheet->save();

            //dd($timesheet);
        }

        flash("$count Timesheets Added.", 'success');
        return redirect()->route('timesheets.create');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
}
