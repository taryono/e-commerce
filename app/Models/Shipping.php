<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at']; 
    public function courier() {
        return $this->belongsTo(Courier::class);
    }
    
    public function shipping_detail() {
        return $this->hasMany(ShippingDetail::class);
    }     
}
