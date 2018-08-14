<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller {

    private $redirectTo = 'comment';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $testimonies = Comment::paginate(20);
        return view('employee.testimony.list', compact('testimonies'));
    }
    
    public function getUsers(Request $request) {
        foreach(\App\User::all() as $user ){
             $data[] = [
                 'id'=> $user->id,
                 'fullname'=> 'TEST',
                 'email'=> $user->email,
                 'profile_picture_url'=> NULL,
             ];
        }
       
        return response()->json($data);
    }
    
    public function getComments(Request $request) { 
        return response()->json(Comment::all()->toArray());
    }
    
    public function postComments(Request $request) { 
        dd($request->input());
         Comment::create($request->input());
         return response()->json(Comment::all()->toArray());
    }
    
    public function putComments(Request $request,$comment_id) {
        $comment =  Comment::find($comment_id);
        $comment->update($request->input());
        return response()->json(Comment::all()->toArray());
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
        $testimony = Comment::create([
                    'name' => $data['name'],
        ]);
        return redirect($this->redirectTo);
    }

    public function show($id) {
        $testimony = Comment::find($id);
        return view('employee.testimony.view', compact('testimony'));
    }

    public function edit($id) {
        $testimony = Comment::find($id);
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
        $testimony = Comment::find($id);
        if ($testimony) {
            $testimony->update([
                'name' => $data['name'], 
            ]);
        }
        return redirect($this->redirectTo);
    }
    
    public function list_testimonies($craft_id) { 
        $testimonies = Comment::where('craft_id', $craft_id)->get(); 
        $user_ids = [];
        if($testimonies->count() > 0){
            foreach($testimonies as $t){
                $user_ids[] = $t->user_id;
            }
        }
        $users = \App\User::whereIn('id', $user_ids)->get(); 
        
        $data['commentsArray'] = $testimonies;
        $data['users'] = $users;
        return response()->json($data);
    }

    public function destroy($id) {
        $testimony = Comment::find($id);
        if ($testimony) {
            return response()->json(['success' => $testimony->delete(), 'redirect' => 'testimony'], 200);
        }
        abort(404);
    }

}
