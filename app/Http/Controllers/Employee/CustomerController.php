<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Customer;
use App\Models\Role;
class CustomerController extends EmployeeController
{    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','menu']);  
    } 
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        $users = \App\User::with('user_detail')->whereHas('roles', function($q){
            $q->where('name', 'customer');
        })->paginate(20);  
        return view('employee.user.list', compact('users'));
    }
    
    public function create(Request $request)
    {	 
        return view('employee.user.create');
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
        if(array_key_exists('roles', $data)){
            $user = Customer::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'address' => $data['address'],
                        'cellphone' => $data['cellphone'],
                        'phone_number' => $data['phone_number'],
                        'date_of_birth' => $data['date_of_birth'],
                        'sex' => $data['sex'], 
                        'user_id' => $user->id,
                        'is_verified' => 0,
            ]); 
            $user->roles()->attach(Role::where('name', 'user')->first());
        } 
        return  redirect($this->redirectTo);
    }
    
    public function edit($id)
    {	$user = User::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('employee.user.edit', compact('roles', 'user'));
    }
    
    public function show($id)
    {	$user = User::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('employee.user.show', compact('roles', 'user'));
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input(); 
        $user = User::find($id);
        $user_detail = $user->user_detail;
        $user_detail->update([
                'first_name'=> $data['first_name'],
                'last_name'=> $data['last_name'],
                'date_of_birth'=> $data['date_of_birth'],
                'sex'=> $data['sex'],
                'address'=> $data['address'],
                'cellphone'=> $data['cellphone'],
                'phone_number'=> $data['phone_number'],
            ]); 
        $is_verified = TRUE;
        foreach($data as $key => $val){
            if(!array_key_exists($key, $data) && !$data[$key]){
                $is_verified = FALSE;
            }
        }
        if($is_verified){
            $user_detail->is_verified = TRUE;
            $user_detail->save();
        }
        return  redirect()->route('customer.index');
    }
}
