<?php

namespace Modules\Authentication\tests\Feature\Controllers;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationControllerHelperTesting extends TestCase
{
    use RefreshDatabase;
    protected $middlewares = ['api', 'json.response', 'auth:api'];

    const ADMIN_EMAIL = 'admin@mail.com';
    const USER_EMAIL = 'admin@mail.com';

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install --force');
        $this->seed([
//            'DatabaseSeeder',
        ]);
    }
}
