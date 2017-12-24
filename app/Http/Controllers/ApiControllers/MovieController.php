<?php

namespace App\Http\Controllers\ApiControllers;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Genre;
use Illuminate\Support\Facades\URL;

/**
 *
 * Manage Movie by Api
 *
 * Class MovieController
 * @package App\Http\Controllers\ApiControllers
 */
class MovieController extends Controller
{
    /**
     *
     * Display a listing of the movies.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        // get all the movies
        $movies = Movie::with(['country','genres'])->get();

        // response
        return jsend_success($movies);
    }

    /**
     *
     * Store a newly created movie in storage.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {

        // validate
        $validator = Validator::make($request->all(), [
            'name'          => 'required|unique:movies,name|max:191',
            'description'   => 'required',
            'release_date'  => 'required|date',
            'rating'        => 'required|integer|between:1,5',
            'ticket_price'  => 'required|numeric',
            'country'       => 'required|string|valid_country',
            'photo_url'     => 'required|string|valid_image_url',
            'genres'        => 'required|string|distinct_comma|valid_genre'
        ]);

        if ($validator->fails()){
            return jsend_fail($validator->errors());
        }

        // save image
        Image::configure(array('driver' => 'imagick'));

        $moviePhoto = Image::make($request->photo_url);
        $moviePhotoName = time().".png";
        $moviePhoto->save(public_path().'/images/movie/'.$moviePhotoName);
        $moviePhotoURL = URL::to('/').'/images/movie/'.$moviePhotoName;

        // save movie
        $movie = new Movie;
        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->release_date = $request->release_date;
        $movie->rating = $request->rating;
        $movie->ticket_price = $request->ticket_price;
        $movie->country_id = Country::where('name', '=',$request->country)->first()->id;
        $movie->photo = $moviePhotoURL;
        $movie->save();

        // save genres
        $genres = explode(',',$request->genres);
        foreach ($genres as $genre) {
            $genre = Genre::where('name', '=', $genre)->first();
            $movie->genres()->save($genre);
        }

        // response
        return jsend_success($movie::with(['country','genres'])->find($movie->id));

    }

    /**
     *
     * Display the specified movie.
     *
     * @param $movie_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show($movie_id)
    {
        // find movie by using movie_id
        $movie = Movie::with(['country','genres'])->find($movie_id);

        // response
        return jsend_success($movie);
    }

    /**
     *
     * Update the specified movie in storage.
     *
     * @param $movie_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $movie_id)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:191',
            'description'   => 'required',
            'release_date'  => 'required|date',
            'rating'        => 'required|integer|between:1,5',
            'ticket_price'  => 'required|numeric',
            'country'       => 'required|string|valid_country',
            'photo_url'     => 'required|string|valid_image_url',
            'genres'        => 'required|string|distinct_comma|valid_genre'
        ]);

        if ($validator->fails()){
            return jsend_fail($validator->errors());
        }

        // save image
        Image::configure(array('driver' => 'imagick'));

        $moviePhoto = Image::make($request->photo_url);
        $moviePhotoName = time().".png";
        $moviePhoto->save(public_path().'/images/movie/'.$moviePhotoName);
        $moviePhotoURL = URL::to('/').'/images/movie/'.$moviePhotoName;

        // save movie
        $movie = Movie::find($movie_id);
        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->release_date = $request->release_date;
        $movie->rating = $request->rating;
        $movie->ticket_price = $request->ticket_price;
        $movie->country_id = Country::where('name', '=',$request->country)->first()->id;
        $movie->photo = $moviePhotoURL;
        $movie->save();

        // detach genres
        $movie->genres()->detach($movie->genres);

        // save genres
        $genres = explode(',',$request->genres);
        foreach ($genres as $genre) {
            $genre = Genre::where('name', '=', $genre)->first();
            $movie->genres()->save($genre);
        }

        // response
        return jsend_success($movie::with(['country','genres'])->find($movie->id));
    }

    /**
     *
     * Remove the specified movie from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        // delete movie
        $movie = Movie::find($id);
        $movie->delete();

        // response
        return jsend_success($movie::with(['country','genres'])->find($movie->id));
    }
}
