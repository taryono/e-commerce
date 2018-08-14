<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PriceController extends EmployeeController
{  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	$request->user()->authorizeRoles(['employee', 'manager']);
        $prices = \App\Models\Price::paginate(15);
        return view('employee.price.list', compact('prices'));
    } 
    
    public function create(Request $request)
    {	  
        return view('employee.price.create');
    }
     
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $craft = \App\Models\Craft::create([
            'code'=> $request->input('code'),
            'name'=> $request->input('name'),
            'category_id'=> $request->input('category_id'),
            'supplier_id'=> $request->input('supplier_id'),
        ]);
    
        \App\Models\CraftDetail::create([
            'craft_id'=> $craft->id,
            'weight'=> $request->input('weight'),
            'height'=> $request->input('name'), 
        ]);
        $craft_image = \App\Models\CraftImage::create([
            'craft_id'=> $craft->id,
            'name'=> $request->input('file_name'), 
        ]);
        
        /*
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        */
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');  
            // image upload in public/upload folder.
            $storage = base_path('public/uploads');
            $directory = $storage."/".$request->input('directory');
            $path = File::createLocalDirectory($directory); 
            $info = File::storeLocalFile($file, $path);   
            $craft_image->path = $path;
            $craft_image->save();
        }
        
        return redirect()->route('craft.index');
    }
    
    public function edit($id)
    {	$price = \App\Models\Price::find($id); 
        return view('employee.price.edit', compact('price'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $craft = \App\Models\Craft::find($id)->update([
            'code'=> $request->input('code'),
            'name'=> $request->input('name'),
            'category_id'=> $request->input('category_id'),
            'supplier_id'=> $request->input('supplier_id'),
        ]);
        if($craft){
            $craft = \App\Models\Craft::create([
                'code'=> $request->input('code'),
                'name'=> $request->input('name'),
                'category_id'=> $request->input('category_id'),
                'supplier_id'=> $request->input('supplier_id'),
            ]);
        }
        $craft_detail = \App\Models\CraftDetail::where('craft_id',$id )->first();
        if($craft_detail){
            $craft_detail->update([
                'craft_id'=> $craft->id,
                'weight'=> $request->input('weight'),
                'height'=> $request->input('name'), 
            ]);
            
            $craft_image = \App\Models\CraftImage::where('craft_id',$id )->first();
            if($craft_image){
                $craft_image->update([
                    'craft_id'=> $craft->id,
                    'name'=> $request->input('file_name'),
                    'thumbnail'=> $request->input('thumbnail'),
                    'path'=> $request->input('path'),
                ]);
            }
            
        }else{
            \App\Models\CraftDetail::create([
                'craft_id'=> $craft->id,
                'weight'=> $request->input('weight'),
                'height'=> $request->input('name'), 
            ]);
            
            $craft_image = \App\Models\CraftImage::where('craft_id',$id )->first();
            if($craft_image){
                $craft_image->update([
                    'craft_id'=> $craft->id,
                    'name'=> $request->input('file_name'),
                    'thumbnail'=> $request->input('thumbnail'),
                    'path'=> $request->input('path'),
                ]);
            }else{
                \App\Models\CraftImage::create([
                    'craft_id'=> $craft->id,
                    'name'=> $request->input('file_name'),
                    'thumbnail'=> $request->input('thumbnail'),
                    'path'=> $request->input('path'),
                ]);
            }
            
        }
        
        
        return redirect()->route('craft.index');
    }
    
    public function show($id)
    {	$craft = \App\Models\Craft::find($id);
        $categories = \App\Models\Category::all(); 
        $suppliers = \App\Models\Supplier::all();
        return view('employee.craft.view', compact('craft','categories','suppliers'));
    }
}
