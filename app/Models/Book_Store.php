<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="3"),
 * @OA\Property(property="author", type="string", readOnly="true", example="Elon Musk"),
 * @OA\Property(property="title", type="string", readOnly="true", example="Lorem ipsum dolor sit amet."),
 * @OA\Property(property="price", type="string", example="554"),
 * @OA\Property(property="category", type="string", readOnly="true", example="9"),

 * )
 *
 */

class Book_Store extends Model
{
    protected $fillable = [
        'author', 'title', 'price', 'category'

    ];

    use HasFactory;
}
