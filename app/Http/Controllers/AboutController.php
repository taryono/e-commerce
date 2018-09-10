<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	$about = \App\Models\Company::first();
        return view('about', compact('about'));
    }
    
     public function update(Request $request, $id)
    {	$company = \App\Models\Company::find($id);  
        if($company){ 
            if ($request->input('name') == "content") {
                $company->content = $request->input('value');
                
            }  
            if ($request->input('name') == "contact") {
                $company->contact = $request->input('value'); 
            }
            
            if ($request->input('name') == "bank_account_number") {
                $company->bank_account_number = $request->input('value'); 
            }
            
            if ($request->input('name') == "bank_account_name") {
                $company->bank_account_name = $request->input('value'); 
            }
            
            if ($request->input('name') == "bank_name") {
                $company->bank_name = $request->input('value'); 
            }
            $company->save();
        }
    }
}
