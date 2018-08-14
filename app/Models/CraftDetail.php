<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CraftDetail extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function craft() {
        return $this->belongsTo(Craft::class);
    } 
    
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    } 

}
