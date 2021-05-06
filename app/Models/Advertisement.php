<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="20"),
 * @OA\Property(property="imageUrl", type="string", readOnly="true", example="https://placeimg.com/400/300/any?86542"),
 * @OA\Property(property="videoUrl", type="string", readOnly="true", example="https://www.youtube.com/watch?v=1O-U_o_rhe_"),
 * @OA\Property(property="advertDescription", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, officiis,dolorem laborum repudiandae inventore"),

 * )
 *
 */
class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageUrl', 'videoUrl', 'advertDescription'
    ];
}
