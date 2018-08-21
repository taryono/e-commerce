<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimony;

class TestimonyController extends EmployeeController {

    private $redirectTo = 'testimony';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $testimonies = Testimony::paginate(20);
        return view('employee.testimony.list', compact('testimonies'));
    }

    public function create(Request $request) {
        return view('employee.testimony.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $testimony = Testimony::create([
                    'name' => $data['name'],
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $testimony = Testimony::find($id);
        return view('employee.testimony.view', compact('testimony'));
    }

    public function edit($id) {
        $testimony = Testimony::find($id);
        return view('employee.testimony.edit', compact('testimony'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $testimony = Testimony::find($id);
        if ($testimony) {
            $testimony->update([
                'name' => $data['name'], 
            ]);
        }
        return redirect($this->redirectTo);
    }
    
    public function getComments($craft_id) { 
        $testimonies = Testimony::where('craft_id', $craft_id)->get(); 
        $user_ids = [];
        if($testimonies->count() > 0){
            foreach($testimonies as $t){
                $user_ids[] = $t->user_id;
            }
        }
        $users = \App\User::whereIn('id', $user_ids)->get(); 
        
        $data['commentsArray'] = $testimonies;
        $data['usersArray'] = $users;
        return response()->json($data);
    }

    public function destroy($id) {
        $testimony = Testimony::find($id);
        if ($testimony) {
            return response()->json(['success' => $testimony->delete(), 'redirect' => 'testimony'], 200);
        }
        abort(404);
    }

}
