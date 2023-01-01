<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function actors(){
        return $this->hasMany(ActorMovie::class);
    }

    public function users(){
        return $this->hasMany(UserMovie::class);
    }
}
