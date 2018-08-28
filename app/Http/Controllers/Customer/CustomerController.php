<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerController extends Controller
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
        return view('home');
    }
    /*
    public function create(Request $request)
    {	$roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.employee.create', compact('roles'));
    }
    */
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
            $employee = Employee::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'address' => $data['address'],
                        'cellphone' => $data['cellphone'],
                        'phone_number' => $data['phone_number'],
                        'date_of_birth' => $data['date_of_birth'],
                        'sex' => $data['sex'],
                        'position' => $data['position'],
                        'user_id' => $user->id,
            ]);
            foreach($data['roles'] as $role)
            $user->roles()->attach(Role::where('name', $role)->first());
        } 
        return  redirect($this->redirectTo);
    }
    
    public function edit($id)
    {	$employee = Employee::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.employee.edit', compact('roles', 'employee'));
    }
    
    public function show($id)
    {	$employee = Employee::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.employee.edit', compact('roles', 'employee'));
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
         
        if(array_key_exists('roles', $data)){
            $employee = Employee::find($id);
            if($employee){
                 $employee->update([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'address' => $data['address'],
                            'cellphone' => $data['cellphone'],
                            'phone_number' => $data['phone_number'],
                            'date_of_birth' => $data['date_of_birth'],
                            'sex' => $data['sex'],
                            'position' => $data['position'], 
                ]);
            }
           
            $employee->user->roles()->detach();
            foreach($data['roles'] as $role)
            $employee->user->roles()->attach(Role::where('name', $role)->first());
        } 
        return  redirect($this->redirectTo);
    }
}
