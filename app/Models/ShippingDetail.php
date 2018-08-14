<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingDetail extends Model {
    use SoftDeletes; 
    public $with = ['cart'];
    public $guarded = ['id'];     
    protected $dates = ['deleted_at']; 
    
    public function cart() {
        return $this->belongsTo(Cart::class);
    } 
    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }

}
