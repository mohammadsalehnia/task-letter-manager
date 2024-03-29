<?php

namespace Modules\Letter\tests\Feature\Controllers;

use App\Models\User;
use Laravel\Passport\Passport;
use Modules\Letter\App\Models\Letter;
use Modules\Letter\App\resources\LetterCollection;
use Modules\Letter\App\resources\LetterResource;
use Modules\Task\App\Models\Task;

class LetterControllerTest extends LetterControllerHelperTesting
{
    private $paginateNumber = 20;

    public function testStoreMethod(): void
    {
        //        $this->withoutExceptionHandling();
        $adminUser = User::factory()->admin()->create();
        Passport::actingAs($adminUser);
        $count = rand(1, 3);
        $tasks = Task::factory()->count($count)->create()->pluck('id');
        $data = Letter::factory()->make()->toArray();
        $data['tasks'] = $tasks;
        $response = $this->postJson(route('api.letters.store'), $data);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => __('api_messages.store_letter_successfully'),
            ]);

        unset($data['tasks']);

        $this->assertDatabaseHas('letters', $data);

        $letter = Letter::where($data)->first();
        $this->assertCount($count, $letter->tasks);
        $this->assertTrue($letter->tasks->first() instanceof Task);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethod(): void
    {
        //         $this->withoutExceptionHandling();
        Letter::factory()->count(30)->create();

        $adminUser = User::factory()->admin()->create();
        Passport::actingAs($adminUser);

        $response = $this->getJson(route('api.letters.index'));

        $resource = new LetterCollection(Letter::latest()->paginate($this->paginateNumber));

        $json = $response->json();

        $response->assertStatus(200);
        $this->assertEquals($json, $resource->response()->getData(true));
        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethodWhenUserNotAdmin(): void
    {
        // $this->withoutExceptionHandling();
        Letter::factory()->count(30)->create();

        $user = User::factory()->user()->create();

        Passport::actingAs($user);

        $response = $this->getJson(route('api.letters.index'));

        $response->assertStatus(403);
        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testIndexMethodWhenUserNotLoggedIn(): void
    {
        // $this->withoutExceptionHandling();
        Task::factory()->count(30)->create();

        $response = $this->getJson(route('api.letters.index'));

        $response->assertStatus(401);
        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testShowMethod(): void
    {
        //        $this->withoutExceptionHandling();
        $letter = Letter::factory()->create();

        Passport::actingAs(User::factory()->admin()->create());
        $response = $this->getJson(route('api.letters.show', $letter->id));
        $json = $response->json();

        $resource = new LetterResource($letter);

        $response->assertStatus(200);
        $this->assertEquals($json, $resource->response()->getData(true));
        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testDestroyMethod(): void
    {
        Passport::actingAs(User::factory()->admin()->create());

        $letter = Letter::factory()->create();

        $response = $this->deleteJson(route('api.letters.destroy', $letter->id));

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => __('api_messages.delete_letter_successfully'),
            ]);

        $this->assertModelMissing($letter);

        $this->assertEquals($this->middlewares, request()->route()->middleware());
    }

    public function testSearchLetters(): void
    {
        $letter1 = Letter::factory()->create(['title' => 'Test Letter 1']);
        $letter2 = Letter::factory()->create(['title' => 'Test Letter 1']);
        $letter3 = Letter::factory()->create(['title' => 'Test Letter 3']);

        $searchData = ['title' => 'Test Letter 1'];
        $result = $this->letterService->filter($searchData);

        $this->assertEquals(2, $result->count());
        $this->assertContains($letter1->title, $result->pluck('title')->toArray());
        $this->assertContains($letter2->title, $result->pluck('title')->toArray());
        $this->assertNotContains($letter3->title, $result->pluck('title')->toArray());

    }
}
