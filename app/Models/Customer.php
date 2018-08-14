<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model {
    use SoftDeletes;
    public $guarded = ['id'];  
    protected $dates = ['deleted_at'];
    public function user(){
        return $this->belongsTo(\App\User::class);
    } 
}
