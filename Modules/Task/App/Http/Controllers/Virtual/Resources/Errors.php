<?php

namespace Modules\Task\App\Http\Controllers\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Errors",
 *      description="Errors",
 *      type="object",
 * )
 */
class Errors
{
    /**
     * @OA\Property(
     *      title="key",
     *      description="error message",
     *      example="value or values"
     * )
     *
     * @var string
     */
    public $key;
}
