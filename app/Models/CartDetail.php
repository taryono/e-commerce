<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at'];
    public function cart() {
        return $this->belongsTo(Cart::class);
    } 
    public function craft(){
        return $this->belongsTo(Craft::class);
    }

}
