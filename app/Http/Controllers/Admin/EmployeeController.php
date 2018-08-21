<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Employee;
use App\Models\Role;
class EmployeeController extends AdminController
{ 
    protected $redirectTo = '/employee';
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	$request->user()->authorizeRoles(['administrator','employee']);
         $users = \App\User::with('user_detail')->whereHas('roles', function($q){
            $q->whereNotIn('name', ['customer','administrator']);
        })->paginate(20);
        return view('admin.employee.list', compact('users'));
    }
    
    public function create(Request $request)
    {	$roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.employee.create', compact('roles'));
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
            $user = Employee::create([
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
    {	$user = User::find($id);
        $roles = Role::whereNotIn('name',['administrator','customer'])->get();  
        return view('admin.employee.edit', compact('roles', 'user'));
    }
    
    public function show($id)
    {	$user = Employee::find($id);
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
            $user = User::find($id);
            if($user){
                 $user->update([
                            'email' => $data['email'], 
                ]);
                if($user->user_detail){
                    $user->user_detail->update([  
                               'address' => $data['address'],
                               'cellphone' => $data['cellphone'],
                               'phone_number' => $data['phone_number'],
                               'date_of_birth' => $data['date_of_birth'],
                               'sex' => $data['sex'], 
                   ]);
                }else{
                    \App\Models\UserDetail::create([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'address' => $data['address'],
                        'cellphone' => $data['cellphone'],
                        'phone_number' => $data['phone_number'],
                        'date_of_birth' => $data['date_of_birth'],
                        'sex' => $data['sex'], 
                        'user_id' => $user->id, 
                    ]);
                }
            }
           
            $user->roles()->detach();
            foreach($data['roles'] as $role)
            $user->roles()->attach(Role::where('name', $role)->first());
        } 
        return  redirect($this->redirectTo);
    }
}
