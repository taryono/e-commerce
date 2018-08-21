<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Charge;

class ChargeController extends EmployeeController {

    private $redirectTo = 'charge';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $charges = Charge::paginate(20);
        return view('employee.charge.list', compact('charges'));
    }

    public function create(Request $request) {
        $provinces = \App\Models\Province::all();
        return view('employee.charge.create', compact('provinces'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $charge = Charge::create([
                    'amount' => $data['amount'],
                    'from_province_id' => $data['from_province_id'],
                    'to_province_id' => $data['to_province_id'],
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $charge = Charge::find($id);
        return view('employee.charge.view', compact('charge'));
    }

    public function edit($id) {
        $charge = Charge::find($id);
        $provinces = \App\Models\Province::all();
        return view('employee.charge.edit', compact('charge','provinces'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $charge = Charge::find($id);
        if ($charge) {
            $charge->update([
                'amount' => $data['amount'],
                'from_province_id' => $data['from_province_id'],
                'to_province_id' => $data['to_province_id'],
            ]);
        }
        return redirect($this->redirectTo);
    }

    public function destroy($id) {
        $charge = Charge::find($id);
        if ($charge) {
            return response()->json(['success' => $charge->delete(), 'redirect' => 'charge'], 200);
        }
        abort(404);
    }

}
