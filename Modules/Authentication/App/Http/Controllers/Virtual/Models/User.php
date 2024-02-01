<?php

namespace Modules\Authentication\App\Http\Controllers\Virtual\Models;
/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
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
     *      title="name",
     *      description="Name of the new user",
     *      example="string"
     * )
     *
     * @var string | null
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="email",
     *      example="test@gmail.com "
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="is_admin",
     *      description="is_admin",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $is_admin;

}
