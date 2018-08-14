<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $with = ['controller'];
    protected $dates = ['deleted_at'];
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function menu_roles() {
        return $this->hasMany(MenuRole::class);
    }

    public function group_menu() {
        return $this->belongsTo(GroupMenu::class);
    }

    public function controller() {
        return $this->belongsTo(Controller::class);
    }

    public function getParent() {
        $parent = Menu::where(['controller_id' => $this->controller_id, 'parent' => 0])->first();
        if ($parent) {
            return $this->id;
        }
        return 0;
    }
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($model) { 
            $menu_roles = $model->menu_roles()->where('menu_id',$model->id)->get();
            if($menu_roles){
                foreach($menu_roles as $mr){
                    $mr->delete();
                }
            }
        });
    }

}
