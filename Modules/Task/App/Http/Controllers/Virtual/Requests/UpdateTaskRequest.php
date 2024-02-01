<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Requests;

/**
 *
 * @OA\Schema(
 *      title="Update Task request",
 *      description="Update Task request body data",
 *      type="object",
 *      required={"title","description","status"},
 *
 * )
 */
class UpdateTaskRequest
{

    /**
     * @OA\Property(
     *      title="title",
     *      description="titl",
     *      example="new title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="description",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="status",
     *      description="status",
     *      example=1
     * )
     *
     * @var integer
     */
    public $status;

}
