<?php

namespace App\Http\Controllers;

use App\Timesheet;
use App\Job;
use App\User;
use App\Tasktype;
use App\Client;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::pluck('name', 'id');
        //$jobs = Job::pluck('code_name', 'id');
        $jobs = Job::select(
                    \DB::raw("CONCAT(code,' - ',name) AS codename"),'id')
                    ->pluck('codename', 'id');

        $tasktypes = Tasktype::pluck('name', 'id');

        $clients = Client::pluck('name', 'id');

        return view('reports.index', compact('users', 'jobs', 'tasktypes', 'clients'));
    }
    public function generate(Request $request, Datatables $datatables)
    {
        //return timesheet entried filtered based on request
        //$timesheets = null;// Timesheet::select(['id', 'job_id', 'user_id', 'tasktype_id', 'date', 'description', 'hours', 'created_at', 'updated_at'])->get();

        $start = $request->start_date;
        $end = $request->end_date;
        $job_id = $request->job_id;
        $user_id = $request->user_id;
        $client_id = $request->client_id;

        $wheres = [];
        if($start){ $wheres[] = ['date', '>=', $start]; }
        if($end){ $wheres[] = ['date', '<=', $end]; }
        if($job_id){ $wheres[] = ['job_id', '=', $job_id]; }
        if($user_id){ $wheres[] = ['user_id', '=', $user_id]; }

       // dd($wheres);
        $timesheets = Timesheet::where($wheres);

        if($client_id){ 
            $timesheets = $timesheets->whereHas('job', function($q) use ($client_id) {
                $q->where('client_id', '=', $client_id);
            });
        }

        $dataTable =  Datatables::of($timesheets)
            ->addColumn('client', function (Timesheet $timesheet) { return $timesheet->job->client ? str_limit($timesheet->job->client->name, 30, '...') : ''; })
            ->addColumn('username', function (Timesheet $timesheet) { return $timesheet->user ? str_limit($timesheet->user->name, 30, '...') : ''; })
            ->addColumn('jobcode', function (Timesheet $timesheet) { return $timesheet->job ? str_limit($timesheet->job->code . ' - ' . $timesheet->job->name, 40, '...') : ''; })
            ->addColumn('tasktype', function (Timesheet $timesheet) { return $timesheet->tasktype ? str_limit($timesheet->tasktype->name, 30, '...') : ''; })
        ;

        return $dataTable->with('total', $timesheets->sum('hours') )->make(true);
        //return response()->json(['data' => $request->all()], 200);
    }
}
