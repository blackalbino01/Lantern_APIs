<?php

namespace App\Http\Resources;

use App\Models\Book_Store;
use Illuminate\Http\Resources\Json\JsonResource;

class BookStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'author' => $this->author,
            'title' => $this->title,
            'price'=> $this->price ,
            'category' => $this->category
        ];
    }
}
