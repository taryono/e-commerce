<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends CustomerController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	   
        return view('home');
    }
    
    public function create(Request $request) {
        return view('customer.cart.create');
    }
    
    public function user_profile(Request $request)
    {	 
        return view('customer.profile.user_profile');
    }
}
