<?php

namespace Modules\Letter\tests\Feature\Controllers;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ControllerHelperTesting extends TestCase
{
    use RefreshDatabase;
    protected $middlewares = ['api', 'json.response', 'auth:api','is-admin'];

    const ADMIN_EMAIL = 'admin@app.com';
    const USER_EMAIL = 'admin@app.com';

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install --force');
        $this->seed([
//            'DatabaseSeeder',
        ]);
    }
}
