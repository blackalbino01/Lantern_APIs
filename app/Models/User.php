<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'institution_name'
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
    
    public function user_profile()
    {
        return $this->hasOne('App\Models\User_Profile');
    }

    public function followers()
    {
        return $this->hasMany_and_belongsTo('App\Models\User', 'App\Models\Relationship', 'followed_id', 'follower_id');
    }
     
    public function following()
    {
        return $this->hasMany_and_belongsTo('App\Models\User', 'App\Models\Relationship', 'follower_id', 'followed_id');
    }


     
}
