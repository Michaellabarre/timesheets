<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use Searchable;
    
    public function jobs(){
    	return $this->hasMany(Job::class);
    }

    public function contacts(){
    	return $this->hasMany(Contact::class);
    }
}
