<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 *
 * @OA\Schema(
 *      title="Link",
 *      description="Link",
 *      type="object",
 * )
 */


class Link
{
    /**
     * @OA\Property(
     *      title="url",
     *      description="url",
     *      example="http://127.0.0.1:8000/api/panel/users?page=1"
     * )
     *
     * @var string
     */
    public $url;

    /**
     * @OA\Property(
     *      title="label",
     *      description="label",
     *      example="1"
     * )
     *
     * @var string
     */
    public $label;

    /**
     * @OA\Property(
     *      title="active",
     *      description="active",
     *      example="true"
     * )
     *
     * @var boolean
     */
    public $active;


}
