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

        $new_cart = \App\Models\Cart::create([
                    'user_id' => $request->input('user_id'),
                    'total' => $request->input('subtotal'),
                    'to_province_id' => $request->input('to_province_id'),
                    'courier_id' => $request->input('courier_id'),
                    'total' => $request->input('total'),
                    'fee' => $request->input('fee'),
                    'status_id' => 1,
        ]);

        $cart_details = \App\Models\CartDetail::create([
                    'cart_id' => $new_cart->id,
                    'craft_id' => $request->input('craft_id'),
                    'price' => $request->input('price'),
                    'amount' => $request->input('amount'),
                    'subtotal' => $request->input('subtotal'),
        ]);
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
            return view('customer.cart.edit', compact('cart', 'craft', 'couriers', 'provinces','carts','total'));
        }
        //
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
                'total' => $request->input('total'),
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
                $craft_detail->stock = $craft_detail->stock+$request->input('amount');
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
            return response()->json(['success' => $cart->delete(), 'redirect' => 'cart.index'], 200);
        }
        abort(404);
    }

}
