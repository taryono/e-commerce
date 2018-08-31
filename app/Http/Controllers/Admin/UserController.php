<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
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
    
    public function edit($id)
    {	$user = User::find($id);
        $roles = Role::where('name','<>', 'administrator')->get();
        return view('admin.user.edit', compact('user', 'roles'));
    }
}
