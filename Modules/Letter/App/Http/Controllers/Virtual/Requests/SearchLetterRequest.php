<?php

namespace Modules\Letter\App\Http\Controllers\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="SearchLetterRequest",
 *      description="Search Letter request body data",
 *      type="object",
 *      required={"title","body"},
 *
 * )
 */
class SearchLetterRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="title",
     *      example="string"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="body",
     *      description="string",
     * )
     *
     * @var string
     */
    public $body;

    /**
     * @OA\Property(
     *      title="user_id",
     *      description="user_id",
     *      example=1
     * )
     *
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(
     *   property="tasks",
     *       type="array",
     *
     *       @OA\Items(
     *          type="number",
     *          example=1,
     *       ),
     *   ),
     *
     * @var array
     */
    public $tasks;
}
