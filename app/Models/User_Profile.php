<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    use HasFactory;

    protected $fillable = [
    	'profile_picture',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
