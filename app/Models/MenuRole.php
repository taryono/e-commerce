<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuRole extends Model {
    use SoftDeletes;
    public $table = "menu_role";
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function menu() {
        return $this->belongsTo(Menu::class);
    } 

}
