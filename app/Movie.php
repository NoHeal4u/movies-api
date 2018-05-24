<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Movie extends Model
{
    //
    public $timestamps = false;

    public static function filter($title, $skip, $take)
    {
    		
    		return self::where('title', 'LIKE', '%'.$title .'%')->skip($skip)->take($take)->get();
    	
    }
}
