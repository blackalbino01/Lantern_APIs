<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Media extends Model
{
    use HasFactory;

    // protected $table = 'lantern_api.user.user_media';

    protected $fillable = [
        'user_id','file'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
