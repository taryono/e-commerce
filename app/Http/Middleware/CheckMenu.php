<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckMenu {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) { 
        
        if (Auth::user()->isAdmin()) {
            return $next($request);
        } else {
            //$params = $request->route()->parameters(); 
            $action = $request->route()->uri;  
            $menus = json_decode(Auth::user()->menus); 
            $roles = Auth::user()->roles()->get();
            $names = [];
            $role_names = [];
            foreach($menus as $m){
                $names[] = $m->concat;
                foreach($roles as $r){
                    $names[] = $r->name.'/'.$m->concat;
                }
            }     
            if(in_array($action,$names)){
                return $next($request);
            }else{
                return redirect()->to('/home');
            }
        }
    }

}
