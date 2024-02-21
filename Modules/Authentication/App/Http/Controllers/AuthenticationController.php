<?php

namespace Modules\Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\User\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\Authentication\App\Http\Requests\LoginRequest;
use Modules\Authentication\App\Http\Requests\RegisterRequest;
use Modules\Authentication\App\resources\UserResource;

/**
 * @OA\Info(
 *    title="APIs Documentation",
 *    version="1.0.0",
 * ),
 */
class AuthenticationController extends Controller
{
    private UserService $userService;

    private UserRepository $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     * path="/api/v1/authentication/register",
     * operationId="Register",
     * tags={"Authentication"},
     * summary="User Register",
     * description="User Register here",
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(),
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password"},
     *
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *
     *    @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="User created successfully"),
     *       @OA\Property(property="token", type="string", example="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTMxNGY2Y2Q4OTliNjY2ZTg3OWIzOGJhYmE4NjU3M2FiN2ExMzQ2NWZmMmJkZmVhMTUxMWQ3ZGUxMDYyOTU4NmE0OWQ2NWZlMmYxNzU4MTAiLCJpYXQiOjE2Nzk4MzM1MzkuNzEwNDQzLCJuYmYiOjE2Nzk4MzM1MzkuNzEwNDQzLCJleHAiOjE2OTU3MzExMzkuNzA5MzU3LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.gQM2KAo_U1mumbqqf0QVdSY35wgKvfUNY9mC0-H58SS5hrC-EkA8EYPCSzvibRQp9DjRsYShBZhz-xL587-QpdjzjjJ70KP1I1ELX7upyK1sBpkhpuB4rbeXId8m_L5mZTtoyHn0udwDOR65ebEXDmlgop2oLOMsPTUMBMu76QuPZO7MWwydCwKO6uC-dZrt6dTYA0hkacUDuIizm4MJ07eJdYxG_MkA52bJYlE6Xt_MgEM-VKod3XW6pzb5SzNGzi0p03XTPH4I2XU4_WYhNPVPUgUxc9qPaO565AirjgyfYuLpbcG2v-ELtryEYyKsbCylJlgF7bUNqo-LD96_K9FXichkh5LOiikqFGWTJlU8eXO3sBkVzNvsj-Bidszje1aOa-6dixgFof-IuloEQXJSKBrfdlrFQVuak4WB4TBxbEPr1qWL05LFcp6bFgslaUl1GWC5XmhkQkj21_DoHDL-j1Yk2F21B8CwrF-scPmoXklbJqd74vm6QGMzYx2V-7YFOwO5RJ1xdcKkmdAJVaXBuM2HNxl_D3Uqhe4CXYZtTxj7rt0qjOLV2ysnUxasdaWDETP1-efDK6dE7NkilB7Ydx-QJKfAa7WbYfEdeOmAHvoyfiWt3E"),
     *    ),
     *  ),
     * )
     */
    public function register(RegisterRequest $request): Response
    {
        $validatedData = $request->validated();
        $this->userService->save($validatedData);

        return response([
            'message' => __('api_messages.auth_success'),
        ], 201);
    }

    /**
     * @OA\Post (
     *      path="/api/v1/authentication/login",
     *      summary="login request",
     *      description="Login by email",
     *      operationId="login",
     *      tags={"Authentication"},
     *
     *      @OA\RequestBody(
     *
     *         @OA\JsonContent(),
     *         required=true,
     *          description="Pass user email number",
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *     ),
     *
     *  @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="text", example="api_messages.login_success"),
     *       @OA\Property(property="token", type="text", example="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTMxNGY2Y2Q4OTliNjY2ZTg3OWIzOGJhYmE4NjU3M2FiN2ExMzQ2NWZmMmJkZmVhMTUxMWQ3ZGUxMDYyOTU4NmE0OWQ2NWZlMmYxNzU4MTAiLCJpYXQiOjE2Nzk4MzM1MzkuNzEwNDQzLCJuYmYiOjE2Nzk4MzM1MzkuNzEwNDQzLCJleHAiOjE2OTU3MzExMzkuNzA5MzU3LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.gQM2KAo_U1mumbqqf0QVdSY35wgKvfUNY9mC0-H58SS5hrC-EkA8EYPCSzvibRQp9DjRsYShBZhz-xL587-QpdjzjjJ70KP1I1ELX7upyK1sBpkhpuB4rbeXId8m_L5mZTtoyHn0udwDOR65ebEXDmlgop2oLOMsPTUMBMu76QuPZO7MWwydCwKO6uC-dZrt6dTYA0hkacUDuIizm4MJ07eJdYxG_MkA52bJYlE6Xt_MgEM-VKod3XW6pzb5SzNGzi0p03XTPH4I2XU4_WYhNPVPUgUxc9qPaO565AirjgyfYuLpbcG2v-ELtryEYyKsbCylJlgF7bUNqo-LD96_K9FXichkh5LOiikqFGWTJlU8eXO3sBkVzNvsj-Bidszje1aOa-6dixgFof-IuloEQXJSKBrfdlrFQVuak4WB4TBxbEPr1qWL05LFcp6bFgslaUl1GWC5XmhkQkj21_DoHDL-j1Yk2F21B8CwrF-scPmoXklbJqd74vm6QGMzYx2V-7YFOwO5RJ1xdcKkmdAJVaXBuM2HNxl_D3Uqhe4CXYZtTxj7rt0qjOLV2ysnUxasdaWDETP1-efDK6dE7NkilB7Ydx-QJKfAa7WbYfEdeOmAHvoyfiWt3E"),
     *    ),
     *  ),
     * )
     */
    public function login(LoginRequest $request): Response
    {
        $validatedData = $request->validated();

        if (! $this->userRepository->existsByEmail($validatedData['email'])) {
            return response([
                'message' => __('api_messages.wrong_email_login_error'),
            ], 422);
        }

        $user = $this->userRepository->findByEmail($validatedData['email']);

        if (! Hash::check($validatedData['password'], $user->password)) {
            return response([
                'message' => __('api_messages.wrong_password_error'),
            ], 422);
        }

        $token = $user->createToken('UserToken')->accessToken;

        return response([
            'message' => __('api_messages.login_success'),
            'token' => 'Bearer '.$token,
        ], 200);
    }

    /**
     * @OA\Get (
     *      path="/api/v1/authentication/get/user/data",
     *      summary="get data",
     *      description="get data",
     *      operationId="getUserData",
     *      tags={"Authentication"},
     *      security={{"passport": {}},},
     *
     *  @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     * )
     */
    public function getUserData(): Response
    {
        $user = auth()->user();

        if (empty($user)) {
            return response([
                'message' => __('api_messages.user_not_found'),
            ]);
        }

        return response(new UserResource($user));
    }
}
