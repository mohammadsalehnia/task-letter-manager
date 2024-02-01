<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *         name="Task"
 *     )
 * )
 */
class Task
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="title",
     *      description="title of taask",
     *      example="string"
     * )
     *
     * @var string | null
     */
    public $title;

    /**
     * @OA\Property(
     *      title="decription",
     *      description="decription of taask",
     *      example="string"
     * )
     *
     * @var string | null
     */
    public $decription;

    /**
     * @OA\Property(
     *      title="status",
     *      description="status of task",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $status;

}
