<?php

namespace Modules\Letter\tests\Unit;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Letter\App\Models\Letter;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Task\App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LetterRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateMethod()
    {
        $repository = $this->app->make(LetterRepository::class);
        $user = User::factory()->create();
        $count = rand(1, 3);
        $tasks = Task::factory()->count($count)->create();
        $data = [
            'title' => 'title',
            'body' => 'body',
            'user_id' => $user->id,
            'tasks' => $tasks->pluck('id')
        ];

        $result = $repository->create($data);

        $this->assertSame($data['title'], $result->title);
    }

    public function testUpdateMethod()
    {
        $repository = $this->app->make(LetterRepository::class);
        $user = User::factory()->create();
        $count = rand(1, 3);
        $tasks = Task::factory()->count($count)->create();
        $letter = Letter::factory()->create();
        $data = [
            'title' => 'new title',
            'body' => 'new body',
            'user_id' => $user->id,
            'tasks' => $tasks->pluck('id')
        ];

        $repository->update($letter, $data);

        $this->assertSame($data['title'], Letter::find($letter->id)->title);
    }

    public function testDeleteMethod()
    {
        $repository = $this->app->make(LetterRepository::class);
        $letter = Letter::factory()->create();

        $repository->delete($letter->id);

        $this->assertDatabaseMissing('letters', $letter->toArray());
    }

    public function testPaginateMethod()
    {
        $repository = $this->app->make(LetterRepository::class);
        $count = rand(1, 50);
        Letter::factory()->count($count)->create();

        $result = $repository->paginate(10);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(10, $result->perPage()); // Ensure per page is correct
    }
}
