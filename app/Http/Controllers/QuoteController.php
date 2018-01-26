<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Job;
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
        $jobs = Job::pluck('code', 'id');
        
        return view('quotes.create', compact('jobs'));

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
            'pm_hours' => 'required',
            'dev_hours' => 'required',
            'design_hours' => 'required',
        ]);

        $quote = new Quote;

        $quote->job_id = $request->input('job_id');
        $quote->pm_hours = $request->input('pm_hours');
        $quote->dev_hours = $request->input('dev_hours');
        $quote->design_hours = $request->input('design_hours');

        $quote->save();

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
        return view('quotes.edit', compact('quote'));
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
        
        $quote->pm_hours = $request->input('pm_hours');
        $quote->design_hours = $request->input('design_hours');
        $quote->dev_hours = $request->input('dev_hours');

        $quote->save();

        return redirect()->route('quotes.index');
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
