<?php

namespace Modules\Authentication\tests\Feature\Controllers;

use App\Models\User;
use Modules\Authentication\App\resources\UserResource;

class AuthenticationControllerTest extends ControllerHelperTesting
{

    public function testRegisterMethod(): void
    {
        $data = User::factory()->make()->toArray();

        $response = $this->postJson(route('api.authentication.register'), [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => 'password',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => __('api_messages.auth_success'),
            ]);
    }

    public function testLoginMethod(): void
    {
//        $this->withoutExceptionHandling();

        $user = User::factory()->user()->create();

        $loginData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson(route('api.authentication.login'), $loginData);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
            ]);
    }

    public function testGetDataMethod(): void
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->user()->create();
        $token = $user->createToken('TestUserToken')->accessToken;

        $response = $this
            ->withHeaders([
                'Authorization' => "Bearer $token",
            ])
            ->getJson(route('api.authentication.user.data'));

        $userData = new UserResource($user);
        $json = json_decode($userData->toJson(), true);

        $responseJson = $response->json();

        $response->assertStatus(200);

        $this->assertEquals($json, $responseJson);

        $this->assertEquals($this->middlewares, request()->route()->middleware());

    }
}
