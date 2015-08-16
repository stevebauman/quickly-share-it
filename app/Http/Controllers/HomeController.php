<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Displays the home page.
     *
     * @return mixed
     */
    public function index()
    {
        return view('pages.home');
    }
}
