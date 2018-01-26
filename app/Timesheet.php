<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
	use Searchable;
    //
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function job(){
    	return $this->belongsTo(Job::class);
    }
    public function tasktype(){
    	return $this->belongsTo(Tasktype::class);
    }
}
