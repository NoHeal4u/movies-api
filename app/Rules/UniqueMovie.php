<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use App\Movie;

class UniqueMovie implements Rule
{   
    protected $title;
    protected $releaseDate;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {   
       $this->title =  $request->input('title');
       $this->releaseDate =  $request->input('releaseDate');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {  
        $a = Movie::where('releaseDate', '=', $this->releaseDate)->count();
        $b = Movie::where('title', '=', $value)->count();
       
        if(Movie::where('releaseDate', '=', $this->releaseDate)->count() > 0 && Movie::where('title', '=', $value)->count() >0){
            return false;
        }else{  

        return true;
        }
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You already have this movie in your database.';
    }
}
