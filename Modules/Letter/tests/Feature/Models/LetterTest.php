<?php

namespace Modules\Letter\tests\Feature\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Letter\App\Models\Letter;
use Modules\Task\App\Models\Task;
use Tests\TestCase;

class LetterTest extends TestCase
{
    use ModelHelperTesting;


    protected function model(): Model
    {
        return new Letter();
    }

    public function testLetterRelationshipWithUser(): void
    {
        $letter = Letter::factory()->for(User::factory())->create();

        $this->assertTrue(isset($letter->user->id));
        $this->assertTrue($letter->user instanceof User);
    }

    public function testLetterRelationshipWithTask(): void
    {
        $count = rand(1, 10);
        $letter = Letter::factory()->hasTasks($count)->create();

        $this->assertCount($count, $letter->tasks);
        $this->assertTrue($letter->tasks->first() instanceof Task);
    }

}
