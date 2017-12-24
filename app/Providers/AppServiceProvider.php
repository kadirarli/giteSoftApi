<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use App\Country;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Exception\NotReadableException;
use App\Genre;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('valid_country', function($attribute, $value, $parameters, $validator) {
            $country = Country::where('name','=',$value)->first();
            if($country == null){
                return false;
            }
            return true;
        });

        Validator::extend('valid_image_url', function ($attribute, $value, $parameters, $validator){
            try{
                $moviePhoto = Image::make($value);
            }catch (NotReadableException $exception){
                return false;
            }
            return true;
        });

        Validator::extend('distinct_comma', function ($attribute, $value, $parameters, $validator){
            $genres = explode(',',$value);
            if (count(array_unique($genres)) < count($genres)) {
                return false;
            }
            return true;
        });

        Validator::extend('valid_genre', function ($attribute, $value, $parameters, $validator){
            $genres = explode(',',$value);
            $wrongGenres = "";
            foreach ($genres as $genre){
                $genre = Genre::where('name', '=',$genre)->first();
                if ($genre == null){
                    $wrongGenres .= $genre.',';
                }
            }
            if ($wrongGenres != "") {
                return false;
            }
            return true;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
