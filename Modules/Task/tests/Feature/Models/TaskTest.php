<?php

namespace Modules\Task\tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Task\App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use ModelHelperTesting;

    protected function model(): Model
    {
        return new Task();
    }
}
