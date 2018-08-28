<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Libraries\File;
use Image;

class CraftController extends EmployeeController
{  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	$crafts = \App\Models\Craft::paginate(20);
        return view('employee.craft.list', compact('crafts'));
    }
    
    public function create(Request $request)
    {	 
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all(); 
        return view('employee.craft.create', compact('categories','suppliers'));
    }
     
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $craft = \App\Models\Craft::create([
            'code'=> $request->input('code'),
            'name'=> $request->input('name'), 
            'description'=> $request->input('description'),
            'category_id'=> $request->input('category_id'),
            'supplier_id'=> $request->input('supplier_id'),
        ]);
    
        \App\Models\CraftDetail::create([
            'craft_id'=> $craft->id,
            'weight'=> $request->input('weight'),
            'price'=> $request->input('price'),
            'height'=> $request->input('height'), 
            'color'=> $request->input('color'),
            'stock'=> $request->input('stock'),
        ]);
        $craft_image = \App\Models\CraftImage::create([
            'craft_id'=> $craft->id, 
        ]);
        
        /*
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        */
        if($request->has('image')){
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');  
                // image upload in public/upload folder.
                $storage = base_path('public/uploads');
                $directory = $storage."/".$craft->category->name;
                $path = File::createLocalDirectory($directory); 
                $info = File::storeLocalFile($file, $path);   
                $craft_image->path = $craft->category->name;
                $craft_image->name = $info->getFilename();
                $craft_image->save();
            }
        }
        return redirect()->route('craft.index');
    }
    
    public function edit($id)
    {	$craft = \App\Models\Craft::find($id);
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        return view('employee.craft.edit', compact('craft','categories','suppliers'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        #dd($request->input());
        try{
            $craft = \App\Models\Craft::find($id);
            if($craft){
                $craft->update([
                    'code'=> $request->input('code'),
                    'name'=> $request->input('name'),
                    'description'=> $request->input('description'),
                    'category_id'=> $request->input('category_id'),
                    'supplier_id'=> $request->input('supplier_id'),
                ]); 
            }
            
        }catch(\Exception $e){
            dd($e->getMessage());
        } 
        $craft_detail = \App\Models\CraftDetail::where('craft_id',$id )->first();
        if($craft_detail){
            $craft_detail->update([
                'craft_id'=> $craft->id,
                'weight'=> $request->input('weight'),
                'height'=> $request->input('height'), 
                'long'=> $request->input('long'), 
                'color'=> $request->input('color'), 
                'price'=> $request->input('price'),
                'stock'=> $request->input('stock'),
            ]);
            if($request->has('image')){
                $craft_image = \App\Models\CraftImage::where('craft_id',$id )->first();
                if($craft_image){ 
                    if ($request->file('image')->isValid()) {
                        $file = $request->file('image');  
                        // image upload in public/upload folder.
                        $storage = base_path('public/uploads');
                        $directory = $storage."/".$craft->category->name;
                        $path = File::createLocalDirectory($directory); 
                        $info = File::storeLocalFile($file, $path); 
                        if(file_exists($path.'/'.$craft_image->name)){
                            unlink($path.'/'.$craft_image->name);
                        } 
                        $craft_image->update([ 
                            'name'=> $info->getFilename(),
                            'thumbnail'=> $request->input('thumbnail'),
                            'path'=> $craft->category->name,
                        ]);
                    }


                }else{
                    $craft_image = \App\Models\CraftImage::create([
                        'craft_id'=> $craft->id,   
                    ]); 
                    if ($request->file('image')->isValid()) {
                        $file = $request->file('image');  
                        // image upload in public/upload folder.
                        $storage = base_path('public/uploads');
                        $directory = $storage."/".$craft->category->name;
                        $path = File::createLocalDirectory($directory); 
                        $info = File::storeLocalFile($file, $path);  

                        $craft_image->update([ 
                            'name'=> $info->getFilename(), 
                            'path'=> $craft->category->name,
                        ]);
                    }

                }
            }
        }else{
            \App\Models\CraftDetail::create([
                'craft_id'=> $craft->id,
                'weight'=> $request->input('weight'),
                'height'=> $request->input('height'), 
                'long'=> $request->input('long'),
                'price'=> $request->input('price'),
                'stock'=> $request->input('stock'),
            ]);
            if($request->has('image')){
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
        }
        
        
        return redirect()->route('craft.index');
    }
    
    public function show($id)
    {	$craft = \App\Models\Craft::find($id);
        $categories = \App\Models\Category::all(); 
        $suppliers = \App\Models\Supplier::all();
        return view('employee.craft.view', compact('craft','categories','suppliers'));
    }
    
    public function destroy($id) {
        $craft = \App\Models\Craft::find($id); 
        return response()->json(['success'=> $craft->delete(),'redirect'=> 'craft']);
    }
}
