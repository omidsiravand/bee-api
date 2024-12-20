<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class menuresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return[
        'title1'=>$this->title1,
        'p'=>$this->p,
        'title'=>$this->title,
        'description'=>$this->description,
        'imageurl'=>$this->image,
       ];
    }
}
