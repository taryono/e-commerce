<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Controller as controller_model;

class ControllerController extends AdminController
{ 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        $controllers = controller_model::paginate(10); 
        return view('admin.controller.list', compact('controllers'));
    }
    
    public function create(Request $request)
    {	$groups = \App\Models\GroupMenu::all(); 
        return view('admin.controller.create', compact('groups'));
    }
    
    public function edit($id)
    {	$controller = \App\Models\Controller::find($id);
        $groups = \App\Models\GroupMenu::all();
        return view('admin.controller.edit', compact('controller','groups'));
    }
    
    public function store(Request $request)
    {	
        $name = "\\App\Http\\Controllers\\".$request->input('name'); 
        controller_model::create([
            'name'=> $name,
            'title'=> $this->setTitle($name), 
            'text'=> $request->input('title'),
            'group_menu_id'=> $request->input('group_menu_id')
        ]);
        return redirect()->route('controller.index');
    }
    
    public function update(Request $request, $id)
    {	$con = controller_model::find($id);
    
        $name = "\\App\Http\\Controllers\\".$request->input('name'); 
        $con->update([
            'name'=> $name,
            'title'=> $this->setTitle($name), 
            'text'=> $request->input('title'), 
            'group_menu_id'=> $request->input('group_menu_id'), 
        ]);
        if($con){
            $menu = \App\Models\Menu::where([
                'controller_id'=> $id,
                'type'=> 'index',
            ])->first();
            if($menu){
                $menu->group_menu_id = $request->input('group_menu_id');
                $menu->save();
                return redirect()->route('controller.index');
            }
            
        }
        abort(404);
        
    }
    
    public function show($id)
    {	 
    }
    public function destroy($id)
    {	$controller = \App\Models\Controller::find($id);
        if($controller){
            $menus = \App\Models\Menu::where([
                'controller_id'=> $id, 
            ])->get();
            foreach($menus as $m){
                $menu_roles = \App\Models\MenuRole::where('menu_id',$id)->get();
                foreach($menu_roles as $mr){
                    $mr->delete();
                }
                $m->delete();
            }  
            if ($controller) {
                return response()->json(['success' => $controller->delete(), 'redirect' => 'controller'], 200);
            } 
        }
        abort(404);
    }
    
    protected function setTitle($name) {
        $text = explode('\\', $name);
        $converted = explode('_',snake_case($text[count($text)-1])); 
        return $converted[0];
    }
}
