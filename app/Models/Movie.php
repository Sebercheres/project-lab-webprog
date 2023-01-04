<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = ['id'];

    protected $casts = [
        'genres' => 'array',
        'actors' => 'array',
        'character_names' => 'array',
    ];

    protected $dates = ['release_date'];

    public function actors(){
        return $this->hasMany(ActorMovie::class);
    }

    public function users(){
        return $this->hasMany(UserMovie::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
