<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    protected $guarded = [];

    public function movies()
    {
        return $this->hasMany(UserMovie::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
