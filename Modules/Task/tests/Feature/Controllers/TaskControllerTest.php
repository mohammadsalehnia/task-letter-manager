<?php

namespace Modules\Task\tests\Feature\Controllers;

use App\Models\User;
use Laravel\Passport\Passport;
use Modules\Task\App\Models\Task;
use Modules\Task\App\resources\TaskCollection;
use Modules\Task\App\resources\TaskResource;


class TaskControllerTest extends TaskControllerHelperTesting
{
    private $paginateNumber = 20;

    public function testStoreMethod(): void
    {
        // $this->withoutExceptionHandling();
        $adminUser = User::factory()->admin()->create();

        Passport::actingAs($adminUser);
        $data = Task::factory()->make()->toArray();
        $response = $this->postJson(route('api.tasks.store'), $data);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => __('api_messages.store_task_successfully'),
            ]);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testStoreMethodIfUserNotAdmin(): void
    {
        // $this->withoutExceptionHandling();
        $adminUser = User::factory()->user()->create();
        Passport::actingAs($adminUser);

        $data = Task::factory()->make()->toArray();

        $response = $this->postJson(route('api.tasks.store'), $data);

        $response
            ->assertStatus(403);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testStoreMethodIfUserNotLoggedIn(): void
    {
        $data = Task::factory()->make()->toArray();

        $response = $this->postJson(route('api.tasks.store'), $data);

        $response->assertStatus(401);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethod(): void
    {
        // $this->withoutExceptionHandling();
        Task::factory()->count(30)->create();

        $adminUser = User::factory()->admin()->create();

        Passport::actingAs($adminUser);

        $response = $this->getJson(route('api.tasks.index'));

        $resource = new TaskCollection(Task::latest()->paginate($this->paginateNumber));

        $json = $response->json();

        $response->assertStatus(200);
        $this->assertEquals($json, $resource->response()->getData(true));

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethodWhenUserNotAdmin(): void
    {
        // $this->withoutExceptionHandling();
        Task::factory()->count(30)->create();

        $user = User::factory()->user()->create();

        Passport::actingAs($user);

        $response = $this->getJson(route('api.tasks.index'));

        $response->assertStatus(403);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethodWhenUserNotLoggedIn(): void
    {
        // $this->withoutExceptionHandling();
        Task::factory()->count(30)->create();

        $response = $this->getJson(route('api.tasks.index'));

        $response->assertStatus(401);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testShowMethod(): void
    {
        $task = Task::factory()->create();

        Passport::actingAs(User::factory()->admin()->create());
        $response = $this->getJson(route('api.tasks.show', $task->id));
        $json = $response->json();

        $resource = new TaskResource($task);

        $response->assertStatus(200);
        $this->assertEquals($json, $resource->response()->getData(true));

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testDestroyMethod(): void
    {
        Passport::actingAs(User::factory()->admin()->create());

        $task = Task::factory()->create();

        $response = $this->deleteJson(route('api.tasks.destroy', $task->id));

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => __('api_messages.delete_task_successfully'),
            ]);

        $this->assertModelMissing($task);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testUpdateMethod(): void
    {
//        $this->withoutExceptionHandling();
        $task = Task::factory()->create();
        $data = Task::factory()->make()->toArray();

        Passport::actingAs(User::factory()->admin()->create());

        $response = $this->patchJson(route('api.tasks.update', $task->id), $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => __('api_messages.update_task_successfully'),
            ]);

        $this->assertEquals(Task::find($task->id)->title, $data['title']);
        $this->assertEquals(Task::find($task->id)->description, $data['description']);
        $this->assertEquals(Task::find($task->id)->status, $data['status']);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testUpdateStatus(): void
    {
        $this->withoutExceptionHandling();

        // Arrange
        $task = Task::factory()->create(['status' => 1]);
        $newStatus = 2;

        //
        Passport::actingAs(User::factory()->admin()->create());
        $data = [
            'status' => $newStatus,
        ];
        $response = $this->patchJson(route('api.tasks.update.status', $task->id), $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => __('api_messages.update_status_successfully'),
            ]);

        $this->assertEquals($newStatus, Task::find($task->id)->status);
    }
}
