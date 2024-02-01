<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 *
 * @OA\Schema(
 *      title="Unauthenticated",
 *      description="Unauthenticated",
 *      type="object",
 *      required={"message"},
 *
 * )
 */

class Unauthenticated
{
    /**
     * @OA\Property(
     *      title="message",
     *      description="error message",
     *      example="Unauthenticated."
     * )
     *
     * @var string
     */
    public $message;

}
