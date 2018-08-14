<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at'];
    public function from_province() {
        return $this->belongsTo(Province::class);
    } 
    
    public function to_province() {
        return $this->belongsTo(Province::class);
    }
    
    public function cart() {
        return $this->hasMany(Cart::class);
    } 

}
