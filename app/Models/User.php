<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserMedia;
use App\Models\Blog;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
