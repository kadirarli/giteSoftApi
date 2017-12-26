<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
