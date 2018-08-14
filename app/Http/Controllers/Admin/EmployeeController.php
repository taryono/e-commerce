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
        $employees = Employee::paginate(5);
        return view('admin.employee.list', compact('employees'));
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
