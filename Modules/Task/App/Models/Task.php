<?php

namespace Modules\Task\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Letter\App\Models\Letter;
use Modules\Task\App\Services\TaskStatus;
use Modules\Task\Database\factories\TaskFactory;

class Task extends Model
{
    use HasFactory;

    public const STATUS_TODO = 1;

    public const STATUS_DOING = 2;

    public const STATUS_DONE = 3;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    private TaskStatus $taskStatus;

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }

    public function transitionTo(TaskStatus $taskStatus): void
    {
        $this->taskStatus = $taskStatus;
        $this->taskStatus->setTask($this);
    }

    public function getTaskStatus(): TaskStatus
    {
        return $this->taskStatus;
    }

    public function getStatus(): int
    {
        return $this->taskStatus->getStatus();
    }

    public function todo(): void
    {
        $this->taskStatus->todo();
    }

    public function doing(): void
    {
        $this->taskStatus->doing();
    }

    public function done(): void
    {
        $this->taskStatus->done();
    }

    public function letters(): BelongsToMany
    {
        return $this->belongsToMany(Letter::class);
    }
}
