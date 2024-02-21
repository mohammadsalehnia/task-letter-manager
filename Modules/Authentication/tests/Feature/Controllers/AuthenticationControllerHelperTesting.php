<?php

namespace Modules\Authentication\tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

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
