<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Item Not Found",
 *      description="Item Not Found",
 *      type="object",
 *      required={"message"},
 *
 * )
 */
class ItemNotFound
{
    /**
     * @OA\Property(
     *      title="message",
     *      description="Item Not Found",
     *      example="Item Not Found"
     * )
     *
     * @var string
     */
    public $message;
}
