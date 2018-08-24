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
        return view('client.product.list', compact('products'));
    }
    
    public function create(Request $request) { 
        return view('client.product.create');
    }

    public function show($id) {
        $crafts = \App\Models\Craft::where('category_id', $id)->paginate(20); 
        return view('welcome', compact('crafts'));
    }

    public function detail($id) { 
        $craft = \App\Models\Craft::where('id', $id)->first();
        $couriers = \App\Models\Courier::all(); 
        $provinces = \App\Models\Province::all();
        return view('detail', compact('craft','couriers', 'provinces'));
    }
    
     public function byCategory($id) {
        $crafts = \App\Models\Craft::where('category_id', $id)->paginate(20); 
        return view('welcome', compact('crafts'));
    }
    
    public function search($keyword) { 
        $craft = \App\Models\Craft::whereHas('craft_detail', function($q) use($keyword){
            $q->where('name', 'LIKE', $keyword);
        })->get(); 
        return view('content', compact('crafts'));
    }

}
