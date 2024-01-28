<?php

namespace Modules\Letter\App\resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Authentication\App\resources\UserResource;
use Modules\Task\App\resources\TaskCollection;

class LetterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'body' => $item->body,
                'user' => new UserResource($item->user),
                'tasks' => new TaskCollection($item->tasks),
            ];
        })->toArray();
    }
}
