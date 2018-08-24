<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User;
use App\Models\Role;
use App\Http\Controllers\Admin\AdminController;

class UserController extends AdminController
{ 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	
        $users = User::paginate(20);
        return view('admin.user.list', compact('users'));
    }
    
    public function create(Request $request)
    {	$roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.user.create', compact('roles'));
    }
    
    public function show($id)
    {	$user = User::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.user.view', compact('user', 'roles'));
    }
    
    public function edit($id)
    {	$user = User::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.user.edit', compact('user', 'roles'));
    }
    
     public function update(Request $request, $id)
    {	$user = User::find($id);
        if($user){
            return redirect()->to(route('user.index'));
        }
    }
    
    public function destroy($id) {
        $user = User::find($id);
        if ($user) { 
            $employee = \App\Models\Employee::where('user_id',$id)->first();
            if($employee){
                $employee->delete();
            }else{
                $customer = \App\Models\Customer::where('user_id',$id)->first();
                if($customer){
                    $customer->delete();
                }
            }
            $user->roles()->detach();
            return response()->json(['success'=> $user->delete(),'redirect'=> 'user'], 200);
        }
        abort(404);
    }
}
