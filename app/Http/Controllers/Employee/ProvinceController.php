<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;

class ProvinceController extends EmployeeController {

    private $redirectTo = 'province';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $provinces = Province::paginate(20);
        return view('employee.province.list', compact('provinces'));
    }

    public function create(Request $request) {
        return view('employee.province.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $province = Province::create([
                    'name' => $data['name'],
                    'km' => $data['km'],                    
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $province = Province::find($id);
        return view('employee.province.view', compact('province'));
    }

    public function edit($id) {
        $province = Province::find($id);
        return view('employee.province.edit', compact('province'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $province = Province::find($id);
        if ($province) {
            $province->update([
                'name' => $data['name'],
                'km' => $data['km'],                
            ]);
        }
        return redirect($this->redirectTo);
    }

    public function destroy($id) {
        $province = Province::find($id);
        if ($province) {
            return response()->json(['success' => $province->delete(), 'redirect' => 'province'], 200);
        }
        abort(404);
    }

}
