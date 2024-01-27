<?php

namespace Modules\Task\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Task\App\Services\TaskStatus;
use Modules\Task\Database\factories\TaskFactory;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
