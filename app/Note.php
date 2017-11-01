<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $table = "notes";
	
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
    
    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }

    public function statistic(){
        return $this->hasOne('App\Statistic');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function dislikes(){
        return $this->hasMany('App\Dislike');
    }

    public function admin_notification(){
        return $this->belongsTo('App\AdminNotification');
    }


}
