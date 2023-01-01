<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorMovie extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function actor(){
        return $this->belongsTo(Actor::class);
    }

    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
