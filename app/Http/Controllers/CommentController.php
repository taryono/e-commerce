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
        $comments = Comment::all();
        return response()->json($comments);
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
         $comments = Comment::all();
        return response()->json($comments);
    }
    
    public function postComments(Request $request) {  
         Comment::create($request->input());
         return response()->json(Comment::all()->toArray());
    }
    
    public function putComments(Request $request,$comment_id) {
        $comment =  Comment::find($comment_id);
        $comment->update($request->input());
        return response()->json(Comment::all()->toArray());
    }

    public function create(Request $request) {
        return view('employee.comment.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) { 
        $comment = $request->input('comment');
        $data =  [
            "id" => $comment['id'],
            "parent" => $comment['parent'],
            "created" => $comment['created'],
            "modified" => $comment['modified'],
            "content" => $comment['content'],
            "fullname" => (Auth::check())?$request->user()->user_detail->first_name.' '.$request->user()->user_detail->last_name:"No Name",
            "profile_picture_url" => $comment['profile_picture_url'],
            "created_by_current_user" => true,
            "upvote_count" => $comment['upvote_count'],
            "user_has_upvoted" => $comment['user_has_upvoted'],
        ];
        $commented = Comment::create($data);
        $commented->craft_id = $request->input('craft_id');
        $commented->user_id = (Auth::check())?$request->user()->id:1;
        $commented->save();
        return response()->json($comment);
    }

    public function show($id) {
        $comment = Comment::find($id);
        return view('employee.comment.view', compact('comment'));
    }

    public function edit($id) {
        $comment = Comment::find($id);
        return view('employee.comment.edit', compact('comment'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $comment = Comment::find($id);
        if ($comment) {
            $comment->update([
                'name' => $data['name'], 
            ]);
        }
        return redirect($this->redirectTo);
    }
    
    public function list_comments($craft_id) { 
        $comments = Comment::where('craft_id', $craft_id)->get(); 
        $user_ids = [];
        if($comments->count() > 0){
            foreach($comments as $t){
                $user_ids[] = $t->user_id;
            }
        }
        $users = \App\User::whereIn('id', $user_ids)->get();  
        return response()->json($comments->toArray());
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        if ($comment) {
            return response()->json(['success' => $comment->delete(), 'redirect' => 'comment'], 200);
        }
        abort(404);
    }

}
