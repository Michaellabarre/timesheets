<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Job;
use App\Tasktype;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quotes = Quote::all();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::whereDoesntHave('quote')->pluck('code', 'id');
        $tasktypes = Tasktype::all();        
        return view('quotes.create', compact('jobs', 'tasktypes'));
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
            'job_id' => 'required|unique:quotes',
        ]);

        $quote = new Quote;

        $quote->job_id = $request->input('job_id');

        $quote->save();

        foreach($request->input('tasktype') as $t_id => $q_hours ){
            $quote->tasktypes()->attach($t_id, ['quoted_hours' => $q_hours ]);
        }

        flash("Quote <strong>$quote->id</strong> saved.", 'success');
        return redirect()->route('quotes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    // public function show(Quote $quote)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        $tasktypes = Tasktype::all();

        //dd($tasktypes, $quote->tasktypes()->get());

        $diff = $tasktypes->diffKeys($quote->tasktypes()->get());

        return view('quotes.edit', compact('quote', 'diff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        //$quote->save();

        foreach($request->input('tasktype') as $t_id => $q_hours ){
            $quote->tasktypes()->syncWithoutDetaching([ $t_id => [ 'quoted_hours' => $q_hours ] ] );
        }

        flash("Quote <strong>$quote->id</strong> updated.", 'success');
        return redirect()->back();//('quotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
        //dd($client);
        Quote::destroy($quote->id);
        return redirect()->route('quotes.index');
    }
}
