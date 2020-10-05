<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'file'
    ];

    /**
     * Get the user that owns the file.
     * A particular file can belong to many user
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
