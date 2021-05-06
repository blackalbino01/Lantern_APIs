<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="data"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="40"),
 * @OA\Property(property="user_id", type="integer", readOnly="true", example="2"),
 * @OA\Property(property="title", type="string", readOnly="true", example="Lorem ipsum dolor sit amet."),
 * @OA\Property(property="body", type="string", example="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, perspiciatis sed? Hic, sapiente amet! Magnam quas reprehenderit, enim repellendus accusamus debitis voluptatibus a tenetur sequi laudantium amet dicta ratione eos assumenda voluptatum officia et. Assumenda aspernatur magni sint optio! Dignissimos praesentium maxime quod, esse odit iure saepe dolores rem facilis."),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="2019-02-25 12:59:20"),
 * )
 *
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
