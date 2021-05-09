<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="profile__picture", type="string", readOnly="true", example="https://placeimg.com/400/300/any?31560"),
 * @OA\Property(property="user_id", type="integer", readOnly="true", example="7"),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * )
 */
class User_Profile extends Model
{
    use HasFactory;

    protected $fillable = [
    	'profile__picture',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
