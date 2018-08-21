<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Courier;

class CourierController extends EmployeeController {

    private $redirectTo = 'courier';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $couriers = Courier::paginate(20);
        return view('employee.courier.list', compact('couriers'));
    }

    public function create(Request $request) {
        return view('employee.courier.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $courier = Courier::create([
                    'name' => $data['name'],
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $courier = Courier::find($id);
        return view('employee.courier.view', compact('courier'));
    }

    public function edit($id) {
        $courier = Courier::find($id);
        return view('employee.courier.edit', compact('courier'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $courier = Courier::find($id);
        if ($courier) {
            $courier->update([
                'name' => $data['name'], 
            ]);
        }
        return redirect($this->redirectTo);
    }

    public function destroy($id) {
        $courier = Courier::find($id);
        if ($courier) {
            return response()->json(['success' => $courier->delete(), 'redirect' => 'courier'], 200);
        }
        abort(404);
    }

}
