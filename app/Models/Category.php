<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", readOnly="true", example="Mathematics"),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * )
 *
 */

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
