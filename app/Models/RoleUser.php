<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model {
    use SoftDeletes;
    public $table = "role_user";
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function role() {
        return $this->belongsTo(Role::class);
    } 
    
    public function user() {
        return $this->belongsTo(User::class);
    } 

}
