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
    
    public function show(Request $request, $id)
    {	$user = $request->user()->where('id', $id)->first();  
        $role = $request->user()->roles()->first();
        return view('profile.user_profile', compact('user','role'));
    }
    
    public function view_password(Request $request, $id)
    {	$user = \App\User::find($id); 
        if($user){ 
            return view('profile.change_password', compact('user'));
        }
        return redirect()->to(route('profile.index'));
    }
    
    public function update_password(Request $request, $id)
    {	$user = \App\User::find($id); 
        if($user){ 
            if($request->has('password')){
                $user->password = bcrypt($request->input('password'));
                $user->save();
            } 
        }
        return redirect()->to(route('profile.index'));
    }
    
     public function update(Request $request, $id)
    {	$user = \App\User::find($id); 
        if($user){
            $user_detail = $user->user_detail;
            $data = $request->input();
            unset($data['email']); 
            $user_detail->update($data);
            $user->name = $user_detail->first_name.' '.$user_detail->last_name;
            $user->save();
            return redirect()->to(route('profile.index'));
        }
    }
}
