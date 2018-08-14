<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMenuRole extends Model { 
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function menu() {
        return $this->belongsTo(Menu::class);
    } 

}
