<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMenu extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function menu() {
        return $this->hasMany(Menu::class);
    }
    
    public function controller() {
        return $this->hasMany(Controller::class);
    }
    
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

}
