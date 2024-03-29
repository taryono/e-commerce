<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Role;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    //'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $user = User::create([
                    //'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
        $user_detail = \App\Models\UserDetail::where('user_id',$user->id)->first();
        if(array_key_exists('role', $data)){
            if($user_detail){
                $user_detail->update([
                        'first_name' => $data['first_name'], 
                        'last_name' => $data['last_name'],
                        'email' => $data['email'],
                        'address' => $data['address'],
                        'cellphone' => $data['cellphone'],
                        'phone_number' => $data['phone_number'],
                        'zip_code' => $data['zip_code'],
                        'user_id' => $user->id,
                ]);
            }else{
                $user_detail =  \App\Models\UserDetail::create([
                            'first_name' => $data['first_name'], 
                            'last_name' => $data['last_name'],
                            'email' => $data['email'],
                            'address' => $data['address'],
                            'cellphone' => $data['cellphone'],
                            'phone_number' => $data['phone_number'],
                            'zip_code' => $data['zip_code'],
                            'user_id' => $user->id,
                ]);
            }
            $user->roles()->attach(Role::where('name', $data['role'])->first());
        }else{ 
            if($user_detail){
                $user_detail->update([ 
                        'first_name' => $data['first_name'], 
                        'last_name' => $data['last_name'],
                        'address' => $data['address'],
                        'cellphone' => $data['cellphone'], 
                        'phone_number' => $data['phone_number'],
                        'zip_code' => $data['zip_code'],
                ]);
            }else{
                $user_detail =  \App\Models\UserDetail::create([ 
                            'first_name' => $data['first_name'], 
                            'last_name' => $data['last_name'],
                            'address' => $data['address'],
                            'cellphone' => $data['cellphone'],
                            'phone_number' => $data['phone_number'],
                            'zip_code' => $data['zip_code'],
                            'user_id' => $user->id,
                ]);
            }
            $user->name = $user_detail->first_name.' '.$user_detail->last_name;
            $user->save();
            $user->roles()->attach(Role::where('name', 'customer')->first());
        }
        return $user;
    }

}
