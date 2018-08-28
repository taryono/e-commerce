<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends EmployeeController
{  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        $craft_detail_ids = [];
        $carts = \App\Models\Cart::where('status_id', 2)->get();
        if($carts){
            foreach($carts as $cart){
                foreach($cart->cart_detail as $detail){
                    $craft_detail_ids[] = $detail->id;
                } 
            }
            $cart_details = \App\Models\CartDetail::whereIn('id', $craft_detail_ids)->paginate(20);
             
            return view('employee.sale.list', compact('cart_details'));
        }
        
    }  
}
