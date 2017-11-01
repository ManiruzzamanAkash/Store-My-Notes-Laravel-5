<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    public function note(){
    	return $this->belongsTo('App\Note');
    }
}
