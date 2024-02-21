<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Task Collection",
 *      description="Task list",
 *      type="object",
 *
 * )
 */
class TaskCollection
{
    /**
     *   @OA\Property(type="array",
     *      title="data",
     *
     *      @OA\Items(ref="#/components/schemas/Task"))
     */
    public $data;

    /**
     * @OA\Property(
     *      title="links",
     *      description="links",
     *    @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/panel/users?page=2"),
     *    @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/panel/users?page=5"),
     *    @OA\Property(property="prev", type="string", example="http://127.0.0.1:8000/api/panel/users?page=1"),
     *    @OA\Property(property="next", type="string", example="http://127.0.0.1:8000/api/panel/users?page=3"),
     * )
     *
     * @var object
     */
    public $links;

    /**
     * @OA\Property(property="meta", type="object", ref="#/components/schemas/Meta")
     *
     * @var string
     */
    public $meta;

    /**
     * @OA\Property(
     *      title="path",
     *      description="path",
     *      example="http://127.0.0.1:8000/api/panel/users"
     * )
     *
     * @var string
     */
    public $path;

    /**
     * @OA\Property(
     *      title="per_page",
     *      description="per_page",
     *      example="10"
     * )
     *
     * @var int
     */
    public $per_page;

    /**
     * @OA\Property(
     *      title="to",
     *      description="to",
     *      example="10"
     * )
     *
     * @var int
     */
    public $to;

    /**
     * @OA\Property(
     *      title="total",
     *      description="total",
     *      example="20"
     * )
     *
     * @var int
     */
    public $total;
}
