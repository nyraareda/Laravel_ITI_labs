<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "postId"=>$this->id,
            "Title"=>$this->title,
            "Body"=>$this->body,
            "postedByUser"=>new UserResource($this->user)
        ];
    }
}
