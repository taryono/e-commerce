<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AclController extends AdminController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
         
        $menus = \App\Models\Menu::all();
        $roles = \App\Models\Role::where('parent', 1)->paginate();
        return view('admin.acl.list', compact('menus', 'roles'));
    }

    public function create(Request $request) {
        $id = $request->input('id');
        $role = \App\Models\Role::find($id);
        $menus = \App\Models\Menu::all();
        return view('admin.acl.edit', compact('role', 'menus'));
    }

    public function edit($id) {
        $role = \App\Models\Role::find($id);
        $menus = \App\Models\Menu::where('parent', 0)->orderBy('name')->paginate(20);
        return view('admin.acl.edit', compact('role', 'menus'));
    }

    public function update(Request $request, $id) {
        $role_id = $request->input('role_id');
        $menu_id = $request->input('menu_id');
        $status = $request->input('status');
        $field = $request->input('field');

        $menu_role = \App\Models\MenuRole::where([
                    'role_id' => $role_id,
                    'menu_id' => $menu_id,
                ])->first();
        if ((int) $status == 0 && $field == "index" && $menu_role) {
            $menu_role->delete();
            return response()->json(['status' => true]);
        } else {
            if (!$menu_role && (int) $status == 1) {
                $menu_role = \App\Models\MenuRole::create([
                            'role_id' => $role_id,
                            'menu_id' => $menu_id,
                ]);
                $menu_role->{$field} = $status;
            } else {
                $menu_role->{$field} = $status;
            }
            $menu_role->save();
            return response()->json(['status' => true]);
        }
    }

    public function show($id) {
        
    }

    public function destroy($id) {
        
    }

}
