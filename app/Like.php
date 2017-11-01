<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likes";

    public function note(){
    	return $this->belongsTo('app\Note');
    }
}
