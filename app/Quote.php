<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	use Searchable;
    //

    public function job(){
    	return $this->belongsTo(Job::class);
    }
}
