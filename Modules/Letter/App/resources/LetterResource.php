<?php

namespace Modules\Letter\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Authentication\App\resources\UserResource;
use Modules\Task\App\resources\TaskCollection;

class LetterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user' => new UserResource($this->user),
            'tasks' => new TaskCollection($this->tasks),
        ];
    }
}
