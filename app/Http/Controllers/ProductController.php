<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $products = \App\Models\Craft::where('is_published', 1)->paginate(20);
        $about = \App\Models\Company::first();
        return view('client.product.list', compact('products','about'));
    }
    
    public function create(Request $request) { 
        return view('client.product.create');
    }

    public function show($id) { 
        $crafts = \App\Models\Craft::where('category_id', $id)->paginate(20); 
        $about = \App\Models\Company::first();
        return view('welcome', compact('crafts','about'));
    }

    public function detail($id) { 
        $about = \App\Models\Company::first();
        $craft = \App\Models\Craft::where('id', $id)->first();
        $couriers = \App\Models\Courier::all(); 
        $provinces = \App\Models\Province::all(); 
        return view('detail', compact('craft','couriers', 'provinces','about'));
    }
    
     public function byCategory($id) { 
        $crafts = \App\Models\Craft::where('category_id', $id)->paginate(20); 
        $about = \App\Models\Company::first();
        return view('welcome', compact('crafts','about'));  
    }
    
    public function search(Request $request) { 
        $keyword = $request->input('search');
        $crafts = \App\Models\Craft::select('id','name')->whereHas('craft_detail', function($q) use($keyword){
            $q->where('name', 'LIKE', '%'.$keyword.'%');
        })->get(); 
        return view('search-content', compact('crafts'));
    } 
}
