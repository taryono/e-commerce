<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $suppliers = \App\Models\Supplier::paginate(20);
        return view('employee.supplier.list', compact('suppliers'));
    }

    public function create(Request $request) {
        return view('employee.supplier.create');
    }

    public function store(Request $request) {
        $supplier = \App\Models\Supplier::create([
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
        ]);
        if ($supplier) {
            return redirect()->to(route('supplier.index'));
        }
    }

    public function edit($id) {
        $supplier = \App\Models\Supplier::find($id);
        if ($supplier) {
            return view('employee.supplier.edit', compact('supplier'));
        }
    }
    
    public function update(Request $request, $id)
    {	$supplier = \App\Models\Supplier::find($id);
    
        if($supplier){
            $supplier->update([
                'name'=>  $request->input('name'),
                'address'=> $request->input('address'),  
            ]);
            
            return redirect()->route('supplier.index');
        }
         
        abort(404);
        
    }


    public function destroy($id) {
        $supplier = \App\Models\Supplier::find($id);
        if ($supplier) { 
            return response()->json(['success'=> $supplier->delete(),'redirect'=> 'supplier'], 200);
        }
        abort(404);
    }

}
