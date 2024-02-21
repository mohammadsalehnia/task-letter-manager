<?php

namespace Modules\Task\tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Letter\App\Models\Letter;
use Modules\Task\App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use ModelHelperTesting;

    protected function model(): Model
    {
        return new Task();
    }

    public function testTaskRelationshipWithLetter(): void
    {
        $count = rand(1, 10);
        $task = Task::factory()->hasLetters($count)->create();

        $this->assertCount($count, $task->letters);
        $this->assertTrue($task->letters->first() instanceof Letter);
    }
}
