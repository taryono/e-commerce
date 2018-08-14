<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at']; 
    protected $with = ['cart_detail'];
    public function user() {
        return $this->belongsTo(\App\User::class);
    } 
    public function cart_detail(){
        return $this->hasOne(CartDetail::class);
    }
    
    public function courier(){
        return $this->belongsTo(Courier::class);
    }
    
    public function status(){
        return $this->belongsTo(Status::class);
    }
    
    public function to_province() {
        return $this->belongsTo(Province::class);
    } 
    
    public function shipping_detail(){
        return $this->hasMany(ShippingDetail::class);
    }

}
