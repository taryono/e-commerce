<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    public function isAdmin() {
        $role = $this->roles()->first(); 
        return ($role->name == "administrator");
    }

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles) {

        if ($this->isAdmin()) {
            return TRUE;
        }
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function getMenus() {
        if ($this->isAdmin()) {
            return \App\Models\Menu::where('parent',0)->get();
        } else {
            $role = $this->roles()->first(); 
            return $role->menus()->where('parent',0)->get();
        }
    }
    
    public function user_detail() {
        return $this->hasOne(\App\Models\UserDetail::class);
    }
    
    public function cart() {
        return $this->hasMany(\App\Models\Cart::class);
    }
    
    /**
     * Check one role
     * @param string $role
     */
    public function getCustomer() {
        return $this->roles()->where('name', 'customer')->get();
    }

}
