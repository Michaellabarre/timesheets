<?php

namespace App\Http\Controllers;

use App\Tasktype;
use Illuminate\Http\Request;

class TasktypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasktypes = Tasktype::all();
        
        return view('tasktypes.index', compact('tasktypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasktypes.create');
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
            'name' => 'required|unique:tasktypes',
        ]);

        $tasktype = new Tasktype;

        $tasktype->name = $request->input('name');

        $tasktype->save();

        flash("Job <strong>$tasktype->name</strong> saved.", 'success');
        if($request->input('prev_url')!==''){
            return redirect($request->input('prev_url'));
        }
        else{
            return redirect()->route('tasktypes.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function show(Tasktype $tasktype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasktype $tasktype)
    {
        //        
        return view('tasktypes.edit', compact('tasktype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasktype $tasktype)
    {
        $this->validate($request,[
            'name' => 'required|unique:tasktypes',
        ]);

        $tasktype->name = $request->input('name');

        $tasktype->save();

        return redirect()->route('tasktypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasktype $tasktype)
    {
        Tasktype::destroy($tasktype->id);
        return redirect()->route('tasktypes.index');
    }
}
