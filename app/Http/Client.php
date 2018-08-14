<?php
namespace App\Http;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Http\Request;

trait Client {

    public function __construct(Request $request) {
         $action = $request->route()?$request->route()->uri:NULL;
    }

}
