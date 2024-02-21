<?php

namespace Modules\Letter\tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait ModelHelperTesting
{
    use RefreshDatabase;

    abstract protected function model(): Model;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsertData()
    {
        $model = $this->model();
        $table = $model->getTable();
        $data = $model::factory()->make()->toArray();
        $model::create($data);

        $this->assertDatabaseHas($table, $data);
    }
}
