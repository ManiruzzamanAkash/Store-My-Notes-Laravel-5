<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $table = "tags";
	
    public function notes(){
    	return $this->belongsToMany('App\Note');
    }
}
