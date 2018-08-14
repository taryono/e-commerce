<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at'];
    public function cart() {
        return $this->hasMany(Cart::class);
    }  
}
