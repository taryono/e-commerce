<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
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
    {	$request->user()->authorizeRoles(['employee', 'manager','customer']);  
        return view('home');
    }
    
    public function create(Request $request) {
        return view('customer.cart.create');
    }
    
    public function user_profile(Request $request)
    {	#$request->user()->authorizeRoles(['employee', 'manager','customer']);  
        return view('customer.profile.user_profile');
    }
    
    public function show(Request $request, $id)
    {	$user = $request->user()->where('id', \Auth::user()->id)->first();  
        $role = $request->user()->roles()->first();
        return view('profile.user_profile', compact('user','role'));
    }
}
