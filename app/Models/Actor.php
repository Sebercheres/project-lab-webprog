<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = ['id'];
    protected $dates = ['date_of_birth'];
    public function movies(){
        return $this->hasMany(ActorMovie::class);
    }
}
