<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model {
    use SoftDeletes;
    public $guarded = ['id'];  
    protected $date = ['deleted_at'];
    
    public function user(){
        return $this->belongsTo(\App\User::class);
    }

}
