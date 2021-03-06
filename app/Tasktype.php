<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasktype extends Model
{
    //
    public function timesheets(){
        return $this->hasMany(Timesheet::class);
    }

    public function quotes(){
    	return $this->belongsToMany(Quote::class);
    }
}
