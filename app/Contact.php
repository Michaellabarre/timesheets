<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	use Searchable;
    
    public function client(){
    	return $this->belongsTo(Client::class);
    }
}
