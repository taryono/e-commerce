<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('auth');
        $about = \App\Models\Company::first();
        view::share('about',$about);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        return view('home');
    }
}
