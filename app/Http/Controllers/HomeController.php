<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application welcome screen to the user.
     *
     * @return mixed
     */
    public function index()
    {
        return view('pages.home');
    }
}
