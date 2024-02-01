<?php

namespace Modules\Letter\tests\Feature\Controllers;

use Illuminate\Support\Facades\Artisan;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\Services\LetterService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LetterControllerHelperTesting extends TestCase
{
    use RefreshDatabase;
    protected $middlewares = ['api', 'json.response', 'auth:api','is-admin'];

    const ADMIN_EMAIL = 'admin@mail.com';
    const USER_EMAIL = 'admin@mail.com';

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install --force');
        $this->seed([
//            'DatabaseSeeder',
        ]);

        $this->letterService = new LetterService(new LetterRepository());

    }
}
