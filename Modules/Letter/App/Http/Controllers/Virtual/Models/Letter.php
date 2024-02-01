<?php

namespace Modules\Letter\App\Http\Controllers\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Letter",
 *     description="Letter model",
 *     @OA\Xml(
 *         name="Letter"
 *     )
 * )
 */
class Letter
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="title",
     *      description="title of taask",
     *      example="string"
     * )
     *
     * @var string | null
     */
    public $title;

    /**
     * @OA\Property(
     *      title="body",
     *      description="body of taask",
     *      example="string"
     * )
     *
     * @var string | null
     */
    public $body;

    /**
     *   @OA\Property(type="array",
     *      title="tasks",
     *      @OA\Items(ref="#/components/schemas/Task"))
     */
    public $tasks;

}
