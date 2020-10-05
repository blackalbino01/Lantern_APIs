<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            'imageUrl'=> $this->imageUrl ? $this->imageUrl : 'No image found for this Ad',
            'videoUrl' => $this->videoUrl ? $this->videoUrl : 'No Video found for this Ad',
            'advertDescription' => $this->advertDescription
        ];
    }
}
