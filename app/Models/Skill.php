<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="category_id", type="integer", readOnly="true", example="7"),
 * @OA\Property(property="name", type="string", readOnly="true", example="Graphics Design"),
 * @OA\Property(property="description", type="string", readOnly="true", example="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, perspiciatis sed? Hic, sapiente amet! Magnam quas reprehenderit, enim repellendus accusamus debitis voluptatibus a tenetur sequi laudantium amet dicta ratione eos assumenda voluptatum officia et"),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * @OA\Property(property="updated_at", type="string", readOnly="true", example="2021-01-13 21:10:45"),
 * )
 *
 */
class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
