<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	use Searchable;
    
    public function quote(){
        return $this->hasOne(Quote::class);
    }
    
    public function client(){
    	return $this->belongsTo(Client::class);
    }

    public function timesheets(){
    	return $this->hasMany(Timesheet::class);
    }

    public function getTime(){
    	return $this->timesheets->sum('hours');
    }



    public function getTaskTime($task = ""){

        $tasktype = Tasktype::where('name',$task)->first();

        return $this->timesheets()->where('tasktype_id',$tasktype->id)
            ->selectRaw('sum(hours) as sum')
            ->first()->sum;
    }

    public function getTotalQuotedTime()
    {
        $total = 0;
        foreach($this->quote->tasktypes()->get() as $tasktype){
            $total += $tasktype->pivot->quoted_hours;
        }
        return $total;
    }


    
    public function totalOverTime()
    {
        return $this->getTotalQuotedTime() - $this->timesheets->sum('hours');
    }

    public function taskRemaining( $t_id = '')
    {
        //$tasktype = Tasktype::where('id',$t_id)->first();
        $hours = $this->taskHours($t_id);
        return $this->quote->tasktypes()->where('id',$t_id)->first()->pivot->quoted_hours - $hours ;   
    }

    public function taskHours( $t_id = '' )
    {
        $tasktype = Tasktype::where('id',$t_id)->first();
        $time = $this->timesheets()->where('tasktype_id',$tasktype->id)
            ->selectRaw('sum(hours) as sum')
            ->first()->sum;

        return ($time)?$time:0;
    }

    public function getTimeByTask(){
    	# code...
    	//$arr = 
    	return $this->timesheets()->with('tasktype')
    		->join('tasktypes', 'timesheets.tasktype_id', '=', 'tasktypes.id')
    		->groupBy('tasktype_id','tasktypes.name')
    		->selectRaw('sum(hours) as sum, tasktypes.name as name')
    		->pluck('sum','name');
    }

    public function getTimeByUser()
    {
    	return $this->timesheets()->with('user')
    		->join('users', 'timesheets.user_id', '=', 'users.id')
    		->groupBy('user_id','users.name')
    		->selectRaw('sum(hours) as sum, users.name as name')
    		->pluck('sum','name');
    }

    public function getTimeByDate()
    {
    	return $this->timesheets()->selectRaw('DATE(date) as date, sum(hours) as hours')
    	      ->groupBy('date')
    	      ->get();

    }

    /*
        Scopes
    */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }
}
