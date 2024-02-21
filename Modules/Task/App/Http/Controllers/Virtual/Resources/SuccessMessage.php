<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Success",
 *      description="SuccessMessage",
 *      type="object",
 *      required={"message"},
 *
 * )
 */
class SuccessMessage
{
    /**
     * @OA\Property(
     *      title="message",
     *      description="success message",
     *      example="success message"
     * )
     *
     * @var string
     */
    public $message;
}
