<?php

namespace App\Http\Controllers;

use App\Job;
use App\Client;
use App\Quote;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');

        return view('jobs.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'client_id' => 'required',
            'code' => 'required|unique:jobs',
            'name' => 'required',
        ]);

        $job = new Job;

        $client = Client::findOrFail($request->input('client_id'));

        $job->code = strtoupper($request->input('code'));
        $job->name = $request->input('name');
        $job->active = $request->has('active');

        $client->jobs()->save($job);

        $job->save();

        $quote = new Quote;        
        $quote->pm_hours = 0;
        $quote->dev_hours = 0;
        $quote->design_hours = 0;
        $job->quote()->save($quote);

        flash("Job <strong>$job->code: $job->name</strong> saved.", 'success');
        if($request->input('prev_url')!==''){
            return redirect($request->input('prev_url'));
        }
        else{
            return redirect()->route('jobs.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $timesheets = $job->timesheets()->orderBy('date')->get();
        return view('jobs.show', compact('job','timesheets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $name = $job->name;
        Job::destroy($job->id);
        flash("Job <strong>$name</strong> deleted.", 'success');
        return redirect(\URL::previous());
        
    }
}
