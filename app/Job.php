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
        return  $this->quote->dev_hours + $this->quote->design_hours + $this->quote->pm_hours;
    }

    public function devOverTime()
    {
        return $this->isOvertime('Development', $this->quote->dev_hours);
    }
    public function pmOverTime()
    {
        return $this->isOvertime('Project Management',$this->quote->pm_hours);
    }
    public function designOverTime()
    {
        return $this->isOvertime('Design', $this->quote->design_hours);
    }
    public function totalOverTime()
    {
        return $this->timesheets->sum('hours') > $this->getTotalQuotedTime();
    }

    public function isOverTime($task='', $quoteTime)
    {
        $tasktype = Tasktype::where('name',$task)->first();
        $time = $this->timesheets()->where('tasktype_id',$tasktype->id)
            ->selectRaw('sum(hours) as sum')
            ->first()->sum;

        return $time > $quoteTime;
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
