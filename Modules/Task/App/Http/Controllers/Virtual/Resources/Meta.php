<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 *
 * @OA\Schema(
 *      title="Meta",
 *      description="Meta",
 *      type="object",
 * )
 */


class Meta
{
    /**
     * @OA\Property(
     *      title="current_page",
     *      description="current_page",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $current_page;

    /**
     * @OA\Property(
     *      title="from",
     *      description="from",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $from;

    /**
     * @OA\Property(
     *      title="last_page",
     *      description="last_page",
     *      example="5"
     * )
     *
     * @var integer
     */
    public $last_page;

    /**
     *   @OA\Property(type="array",
     *      title="links",
     *      @OA\Items(ref="#/components/schemas/Link"))
     */
    public $links;

}
