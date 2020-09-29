<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_Store extends Model
{
    protected $fillable = [
        'author', 'title', 'price', 'category'

    ];

    use HasFactory;
}
