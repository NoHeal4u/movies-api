<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Rules\UniqueMovie;
use Illuminate\Validation\Rule;

class Movies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
   {   //dd(Movie::filter($request->title, $request->take, $request->skip));
        // return Movie::Filter($request->title);
        // return Movie::all();
        $title = request()->input('title');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Movie::get()->count());
       
        if ($title) {
            return Movie::filter($title, $skip, $take);
        } else {
            return Movie::skip($skip)->take($take)->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //dd($request->input('releaseDate'));
        // $inputTitle = $request->input('title');
        // $inputReleaseDate = $request->input('releaseDate');
         // dd(Movie::where('releaseDate', '=', $inputReleaseDate)->count());

        $validatedData = $request->validate([
          // 'title' => ['required', new UniqueMovie( $request)], ovo sam ja napravio ali nije bilo optimalno i error proof
          'title' => [
            'required', 
            Rule::unique('movies')
                ->where('releaseDate', request('releaseDate')) //optimalan metod iz resenja, doduse trebalo bi u neku svoju klasu da ide
            ],  
          'director' => 'required',
          'duration' => 'required|integer|between:1,500',
          'releaseDate' => 'required',
          'imageUrl' => 'URL',


         ]);

        $movie = new Movie();

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');
        

        $movie->save();

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

         $validatedData = $request->validate([
          'title' => [
            'required', 
            Rule::unique('movies')
                ->where('releaseDate', request('releaseDate'))->ignore($request->id) 
            ],  
          'director' => 'required',
          'duration' => 'required|integer|between:1,500',
          'releaseDate' => 'required',
          'imageUrl' => 'URL',


         ]);


        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return new JsonResponse(true);
    }
}
