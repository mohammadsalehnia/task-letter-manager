<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;
/**
 *
 * @OA\Schema(
 *      title="Channel Resource",
 *      description="Get Channel",
 *      type="object",
 *
 * )
 */

class TaskResource
{
    /**
     *
     * @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
     *
     * @var string
     */
    public $data;
}
