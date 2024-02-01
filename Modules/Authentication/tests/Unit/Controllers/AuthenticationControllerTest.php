<?php

namespace Modules\Authentication\tests\Unit\Controllers;

use App\Repositories\UserRepository;
use App\Services\User\UserService;
use Modules\Authentication\App\Http\Controllers\AuthenticationController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationControllerTest extends TestCase
{
    public function testConstructor()
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userRepository = $this->createMock(UserRepository::class);

        $controller = new AuthenticationController($userServiceMock, $userRepository);

        $this->assertInstanceOf(AuthenticationController::class, $controller);
    }
}
