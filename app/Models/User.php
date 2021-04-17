<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserMedia;
use App\Models\Blog;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 *
 * @OA\Schema(
 * required={"password"},
 * @OA\Xml(name="user"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="3"),
 * @OA\Property(property="name", type="string", readOnly="true", description="User role", example="Constantin Littel III"),
 * @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="vella.bradtke@yahoo.com"),
 * @OA\Property(property="email_verified_at", type="string", readOnly="true", format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),
 * @OA\Property(property="country", type="string", readOnly="true", description="User's country of origin", example="Isle of Man"),
 * @OA\Property(property="gender", type="string", readOnly="true", description="User gender", example="male"),
 * @OA\Property(property="number", type="string", readOnly="true", description="User phone number", example="1-281-943-3838 x1048"),
 * @OA\Property(property="username", type="string", readOnly="true", description="User nickname", example="oking"),
 * @OA\Property(property="birth_date", type="string", readOnly="true", description="User date of birth", example="1995-09-05"),
 * @OA\Property(property="institution_type", type="string", readOnly="true", description="Tertiary Institution type", example="University"),
 * @OA\Property(property="institution_name", type="string", readOnly="true", description="User institution name", example="University Of Nigeria, Nsukka"),
 * @OA\Property(property="department", type="string", readOnly="true", description="User department", example="Computer Science"),
 * @OA\Property(property="faculty", type="string", readOnly="true", description="User Faculty", example="Physical and Applied science"),
 * @OA\Property(property="education_level", type="string", readOnly="true", description="User year of study", example="Third year"),
 * @OA\Property(property="created_at", type="string", readOnly="true", description="date User registered", example="2019-02-25 12:59:20"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", description="last date user updated their profile", example="2019-02-25 12:59:20"),


 * )
 *
 */


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'gender',
        'number',
        'username',
        'birth_date',
        'institution_type',
        'institution_name',
        'department',
        'faculty',
        'education_level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userMedia()
    {
        return $this->hasMany(UserMedia::class);

    }


    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

    public function user_profile()
    {
        return $this->hasOne('App\Models\User_Profile');
    }

    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'follower_id', 'followed_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
