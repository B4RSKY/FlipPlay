<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'type'     => $this->type,
            'genre'    => $this->genre,
            'year'     => $this->year,
            'duration' => $this->when($this->type === 'movie', $this->duration),
            'episodes' => $this->when($this->type === 'series', $this->episodes),
            'users'    => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
