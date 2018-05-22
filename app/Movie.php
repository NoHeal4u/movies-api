<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    public $timestamps = false;

    public static function Filter($search)
    {
    	if(!$search){
    		return Movie::all();
    	}else{
    		return Movie::where('title', 'LIKE', '%'.$search .'%');
    	}
    }
}
