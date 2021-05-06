<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="user_id", type="integer", readOnly="true", example="7"),
 * @OA\Property(property="file", type="string", readOnly="true", example="https://placeimg.com/400/300/any?31560"),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * )
 *
 */

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
