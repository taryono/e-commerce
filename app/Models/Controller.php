<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controller extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function menus() {
        return $this->hasMany(Menu::class);
    }
    
    public function group_menu() {
        return $this->belongsTo(GroupMenu::class);
    }

    protected static function boot() {
        parent::boot();

        static::saved(function($model) {
            $title = $model->title;
            $prefix = $model->prefix;
            $names = [
                $title . '.index' => ['v' => $title, 'a' => 'index', 'p' => NULL, 'method' => 'get', 't' => 'index', 'c' => $title, 'm'=> 'get'],
                $title . '.create' => ['v' => $title . '/create', 'a' => 'create', 'p' => NULL, 'method' => 'get', 't' => 'create', 'c' => $title . '/create'],
                $title . '.edit' => ['v' => $title . '/{' . $model->title . '}/edit', 'a' => 'edit', 'p' => '{' . $model->title . '}', 'method' => 'get', 't' => 'edit', 'c' => $title . '/{' . $model->title . '}/edit'],
                $title . '.store' => ['v' => $title . '/{' . $model->title . '}', 'a' => 'store', 'p' => NULL, 'method' => 'post', 't' => 'save', 'c' => $title . '/{' . $model->title . '}'],
                $title . '.update' => ['v' => $title . '/{' . $model->title . '}', 'a' => 'update', 'p' => NULL, 'method' => 'post', 't' => 'update', 'c' => $title . '/{' . $model->title . '}'],
                $title . '.show' => ['v' => $title . '/{' . $model->title . '}', 'a' => 'show', 'p' => '{' . $model->title . '}', 'method' => 'get', 't' => 'show', 'c' => $title . '/{' . $model->title . '}'],
                $title . '.destroy' => ['v' => $title . '/{' . $model->title . '}', 'a' => 'destroy', 'p' => '{' . $model->title . '}', 'method' => 'get', 't' => 'destroy', 'c' => $title . '/{' . $model->title . '}'],
            ];
            $parent = 0;
            foreach ($names as $key => $name) {
                $menu = Menu::where([
                            'route' => $key,
                            'name' => $name['v'],
                            'controller_id' => $model->id,
                            'action' => '@' . $name['a'],
                        ])->first();
                if (!$menu) {
                    $menu = Menu::create([
                                'route' => $key,
                                'name' => $name['v'],
                                'controller_id' => $model->id,
                                'action' => '@' . $name['a'],
                                'nav_type' => 'top-right',
                                'type' => $name['t'],
                                'method' => $name['method'],
                                'parent' => 0,
                                'position' => 'bo',
                                'title' => $name['t'],
                                'param' => $name['p'],
                                'is_published' => 1,
                                'group_menu_id' => $model->group_menu_id,
                                'concat' => $name['c']
                    ]);
                    if($menu->type == "index"){
                        $parent = $menu->id;
                    }else{
                        $menu->parent = $parent;
                        $menu->save();
                    }
                }

                $users = \App\User::all();
                foreach ($users as $user) {
                    if ($user->hasRole('administrator')) {
                        $role = $user->roles()->first();
                        if ($menu->type == "index") {
                            $menu_role = MenuRole::where([
                                        'role_id' => $role->id,
                                        'menu_id' => $menu->id,
                            ])->first();
                             
                            if (!$menu_role) {
                                $menu_role = MenuRole::create([
                                            'role_id' => $role->id,
                                            'menu_id' => $menu->id,
                                            'index' => 1,
                                            'create' => 1,
                                            'store' => 1,
                                            'update' => 1,
                                            'show' => 1,
                                            'edit' => 1,
                                            'destroy' => 1,
                                ]);
                            }
                        }
                    }
                }
            }
        });
    }

}
