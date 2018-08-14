<?php

namespace App\Models; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class UserDetail extends Model {
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}
