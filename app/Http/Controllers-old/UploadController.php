<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\File;
use Image;

class UploadController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $categories = \App\Models\Category::all();
        return view('image_upload', compact('categories'));
    }

    public function save(Request $request) {  
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
        }
        
    }

}
