<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Craft extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at'];
    public $with = ['category','craft_detail','craft_image'];
    public function category() {
        return $this->belongsTo(Category::class);
    } 
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    } 
    
    public function cart_detail() {
        return $this->hasMany(CartDetail::class);
    }
    
    public function craft_detail(){
        return $this->hasOne(CraftDetail::class);
    }
    
    public function craft_image(){
        return $this->hasOne(CraftImage::class);
    }

}
