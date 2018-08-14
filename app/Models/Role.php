<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function users() {
        return $this->belongsToMany(User::class);
    }
    
    public function group_menu() {
        return $this->belongsToMany(GroupMenu::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }
     
}
