<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $table = "dislikes";

    public function note(){
    	return $this->belongsTo('app\Note');
    }
}
