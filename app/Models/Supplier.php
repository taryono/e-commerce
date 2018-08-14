<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function crafts() {
        return $this->hasMany(Stock::class);
    } 
    
    public function status() {
        return $this->belongsTo(Craft::class);
    } 

}
