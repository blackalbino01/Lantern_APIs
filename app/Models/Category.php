<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   use HasFactory;

   protected $fillable = [
    	'name',
    ];

   public function subjects(){
   		return $this->hasMany('App\Models\Subject');
   }

   public function skills()
   {
   		return $this->hasMany('App\Models\Skill');
   }

   public function interests()
   {
   		return $this->hasMany('App\Models\Interest');
   }
}
