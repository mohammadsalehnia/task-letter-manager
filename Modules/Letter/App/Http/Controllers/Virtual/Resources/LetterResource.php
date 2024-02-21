<?php

namespace Modules\Letter\App\Http\Controllers\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Channel Resource",
 *      description="Get Channel",
 *      type="object",
 *
 * )
 */
class LetterResource
{
    /**
     * @OA\Property(property="data", type="object", ref="#/components/schemas/Letter")
     *
     * @var string
     */
    public $data;
}
