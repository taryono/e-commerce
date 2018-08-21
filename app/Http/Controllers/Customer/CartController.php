<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->user()->authorizeRoles(['employee', 'manager', 'customer']);
        $carts = \App\Models\Cart::where('user_id', $request->user()->id)->paginate(20);
        if ($request->user()->isAdmin() || $request->user()->hasRole('employee')) {
            $carts = \App\Models\Cart::paginate(20);
            return view('employee.cart.list', compact('carts'));
        }
        
        return view('customer.cart.list', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = \App\Models\Category::all();
        return view('customer.cart.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request) {
        $check_cart = \App\Models\Cart::where('status_id', 1)->first();
        if($check_cart){
            $cart_detail = \App\Models\CartDetail::where([
                        'cart_id' => $check_cart->id,
                        'craft_id' => $request->input('craft_id'),                        
            ])->first();
            if($cart_detail){
                $cart_detail->update([
                    'price' => $request->input('price'),
                    'amount' => $request->input('amount'),
                    'subtotal' => $request->input('subtotal'),
                ]); 
            }else{
                $cart_detail = \App\Models\CartDetail::create([
                        'cart_id' => $check_cart->id,
                        'craft_id' => $request->input('craft_id'),
                        'price' => $request->input('price'),
                        'amount' => $request->input('amount'),
                        'subtotal' => $request->input('subtotal'),
                ]);
            }
            $cart_subtotal = 0;
            foreach($check_cart->cart_detail as $d){
                if($request->input('craft_id') != $d->craft_id){
                    $cart_subtotal += $d->subtotal;
                }
            }
            $check_cart->subtotal = $cart_subtotal + $cart_detail->subtotal;
            $check_cart->total =  $cart_subtotal + $cart_detail->subtotal +$check_cart->fee;
            $check_cart->save();
        }else{  
            $province = \App\Models\Province::find($request->input('to_province_id')); 
            $fee = $province->km * 10000;
            $new_cart = \App\Models\Cart::create([
                        'user_id' => $request->input('user_id'),
                        'total' => $request->input('subtotal'),
                        'to_province_id' => $request->input('to_province_id'),
                        'courier_id' => $request->input('courier_id'),
                        'subtotal' => $request->input('subtotal'),                        
                        'fee' => $fee,
                        'total' => $fee + $request->input('subtotal'),
                        'status_id' => 1,
            ]);

            $cart_detail = \App\Models\CartDetail::create([
                        'cart_id' => $new_cart->id,
                        'craft_id' => $request->input('craft_id'),
                        'price' => $request->input('price'),
                        'amount' => $request->input('amount'),
                        'subtotal' => $request->input('subtotal'),
            ]);
        }
        
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit(Request $request, $id) {
        $carts = \App\Models\Cart::where('user_id', $request->user()->id)
                ->where('status_id', 1)
                ->where('id','<>', $id)->get();
        $cart = \App\Models\Cart::where('id', $id)->first();
        $total = 0;
        foreach($carts as $cr){
            $total += $cr->total;
        }
        $total = $total + $cart->total;
        $craft = $cart->cart_detail->craft;
        $couriers = \App\Models\Courier::all();
        $provinces = \App\Models\Province::all();
        if ($request->user()->hasRole('employee')) {
            return view('employee.cart.edit', compact('cart', 'craft', 'couriers', 'provinces'));
        } else {
            return view('customer.cart.edit-old', compact('cart', 'craft', 'couriers', 'provinces','carts','total'));
        }
    }*/
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $cart = \App\Models\Cart::where('id', $id)->first();
        
        $craft = $cart->cart_detail->craft;
        $couriers = \App\Models\Courier::all();
        $provinces = \App\Models\Province::all();
        if ($request->user()->hasRole('employee')) {
            return view('employee.cart.edit', compact('cart', 'craft', 'couriers', 'provinces'));
        } else {
            return view('customer.cart.edit', compact('cart', 'craft', 'couriers', 'provinces','carts','total'));
        }
    }
    
    public function list_by_cart($id) {
        $cart = \App\Models\Cart::where('id', $id)->first();
        
        $cart_details = $cart->cart_detail;
        return view('customer.cart.list_by_cart', compact('cart_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) { 
        $cart = \App\Models\Cart::find($id);
        if ($request->user()->hasRole('employee','manager','administrator')) {
            $cart->update([
                'status_id' => $request->input('status_id'),
            ]);
        } else {
            $cart->update([
                'user_id' => $request->input('user_id'), 
                'to_province_id' => $request->input('to_province_id_post'),
                'courier_id' => $request->input('courier_id'), 
                'fee' => $request->input('fee'),
                'status_id' => $request->input('status_id'),
            ]);
            $cart_detail = $cart->cart_detail;
            $cart_detail->update([
                'cart_id' => $cart->id,
                'craft_id' => $request->input('craft_id'),
                'price' => $request->input('price'),
                'amount' => $request->input('amount'),
                'subtotal' => $request->input('subtotal'),
            ]);
            $craft_detail = $cart_detail->craft->craft_detail;
            
            
            if($request->input('status_id') == 1){
                
            }else if($request->input('status_id') == 2){
                $craft_detail->stock = $request->input('last_stock'); 
            }else{
                #$craft_detail->stock = $craft_detail->stock+$request->input('amount');
                $cart->delete();
            }
            $craft_detail->save();
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $cart = \App\Models\Cart::find($id);
        if ($cart) {
            $cart_details = $cart->cart_detail;
            if($cart_details->count()> 0){
                foreach($cart_details as $detail){
                   /* $craft_detail = $detail->craft->craft_detail;
                    $craft_detail->stock = $craft_detail->stock + $detail->amount;
                    $craft_detail->save();*/
                    $detail->delete();
                }
            }
            return response()->json(['success' => $cart->delete(), 'redirect' => route( 'cart.index')], 200);
        }
        abort(404);
    }
    
    public function get_cart_detail($id) { 
        $cart_detail = \App\Models\CartDetail::where('id', $id)->first();
        
        $craft = $cart_detail->craft;
        $cart = $cart_detail->cart;
        $couriers = \App\Models\Courier::all();
        $provinces = \App\Models\Province::all();
        return view('customer.cart.edit', compact('cart', 'craft', 'couriers', 'provinces','cart_detail'));
    }
    
    public function update_cart_detail(Request $request, $id) { 
        $cart_detail = \App\Models\CartDetail::find($id); 
        $cart_detail->update([ 
                'amount' => $request->input('amount'),
                'subtotal' => $request->input('subtotal'),
        ]);
        
        $cart = $cart_detail->cart;
        $cart_details = $cart->cart_detail;
        $subtotal = 0;
        foreach($cart_details as $detail){
            $subtotal += $detail->subtotal;
        }
        $cart->subtotal = $subtotal;
        $cart->total = $cart->subtotal+$cart->fee;
        $cart->save();
        /*$craft_detail = $cart_detail->craft->craft_detail;
        $craft_detail->stock =  $craft_detail->stock - $request->input('amount');
        $craft_detail->save();*/
        
        return redirect()->route('cart.index');
    }
    
    public function delete_cart_detail($id) {
        $cart_detail = \App\Models\CartDetail::find($id); 
        if($cart_detail){
            /*$craft_detail = $cart_detail->craft->craft_detail;
            $craft_detail->stock = $craft_detail->stock + $cart_detail->amount;
            $craft_detail->save();*/
            $cart = $cart_detail->cart;
            $cart->total = $cart->total - $cart_detail->subtotal;
            if(($cart->subtotal - $cart_detail->subtotal) > 0){
                $cart->save();
            }else{
                $cart->delete();
            }
            
            return response()->json(['success' => $cart_detail->delete(), 'redirect' =>route( 'cart.index')], 200);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paid($cart_id) {
        $cart = \App\Models\Cart::find($cart_id);
        return view('customer.cart.paid', compact('cart'));
    }

}
