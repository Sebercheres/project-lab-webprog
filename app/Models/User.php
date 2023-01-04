<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function movies(){
        return $this->hasMany(UserMovie::class);
    }
}
