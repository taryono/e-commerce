<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends EmployeeController {

    private $redirectTo = 'shipping';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $shippings = Shipping::paginate(20); 
        return view('employee.shipping.list', compact('shippings'));
    }

    public function create(Request $request) {
        $couriers = \App\Models\Courier::all();
        return view('employee.shipping.create', compact('couriers'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $shipping = Shipping::create([
                    'courier_id' => $request->input('courier_id'),
                    'user_id'=> $request->user()->id,
                    'send_date'=> $request->input('send_date'),
        ]);
        if($shipping){
            foreach($request->input('cart_ids') as $cart_id){
                $shipping_detail = \App\Models\ShippingDetail::create([
                    'cart_id' => $cart_id,
                    'shipping_id'=> $shipping->id,
                ]);
            }
        }
        return redirect($this->redirectTo);
    }

    public function show($id) {  
        $shipping = Shipping::find($id);
        return view('employee.shipping.view', compact('shipping'));
    }

    public function edit($id) {
        $shipping = Shipping::find($id);
        $couriers = \App\Models\Courier::all();
        return view('employee.shipping.edit', compact('shipping','couriers'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $shipping = Shipping::find($id);
        $shipping->update([
                    'courier_id' => $request->input('courier_id'),
                    'user_id'=> $request->user()->id,
                    'send_date'=> $request->input('send_date'),
        ]);
        if($shipping){
            $shipping_details = \App\Models\ShippingDetail::where()->get();
            if($shipping_details->count()>0){
                foreach($shipping_details as $detail){
                    $detail->delete();
                }
            }
            foreach($request->input('cart_ids') as $cart_id){
                $shipping_detail = \App\Models\ShippingDetail::create([
                    'cart_id' => $cart_id,
                    'shipping_id'=> $shipping->id,
                ]);
            }
        }
        return redirect($this->redirectTo);
    }

    public function destroy($id) {
        $shipping = Shipping::find($id);
        if ($shipping) {
            return response()->json(['success' => $shipping->delete(), 'redirect' => 'shipping'], 200);
        }
        abort(404);
    }
    
    public function listCart(Request $request) { 
        $carts = \App\Models\Cart::where(['status_id'=> 2,'courier_id'=> $request->input('courier_id') ])->paginate(20);
        return view('employee.shipping.list_cart', compact('carts'));
    }
    
    public function detail($id) { 
        $shipping_details = \App\Models\ShippingDetail::where([ 
                    'shipping_id'=> $id,
                ])->get();
        return view('employee.shipping.detail', compact('shipping_details'));
    }

}
