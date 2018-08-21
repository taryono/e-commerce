<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class StatusController extends EmployeeController {

    private $redirectTo = 'status';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $statutes = Status::paginate(20);
        return view('employee.status.list', compact('statutes'));
    }

    public function create(Request $request) {
        return view('employee.status.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $status = Status::create([
                    'name' => $data['name'],
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $status = Status::find($id);
        return view('employee.status.view', compact('status'));
    }

    public function edit($id) {
        $status = Status::find($id);
        return view('employee.status.edit', compact('status'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $status = Status::find($id);
        if ($status) {
            $status->update([
                'name' => $data['name'], 
            ]);
        }
        return redirect($this->redirectTo);
    }

    public function destroy($id) {
        $status = Status::find($id);
        if ($status) {
            return response()->json(['success' => $status->delete(), 'redirect' => 'status'], 200);
        }
        abort(404);
    }

}
