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

class AuthenticationController extends Controller
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): Response
    {
        $validatedData = $request->validated();
        $this->userService->save($validatedData);

        return response([
            'message' => __('api_messages.auth_success'),
        ], 201);
    }

    public function login(LoginRequest $request): Response
    {
        $validatedData = $request->validated();

        if (!$this->userRepository->existsByEmail($validatedData['email'])) {
            return response([
                'message' => __('api_messages.wrong_email_login_error'),
            ], 422);
        }

        $user = $this->userRepository->findByEmail($validatedData['email']);

        if (!Hash::check($validatedData['password'], $user->password)) {
            return response([
                'message' => __('api_messages.wrong_password_error'),
            ], 422);
        }

        $token = $user->createToken('UserToken')->accessToken;

        return response([
            'message' => __('api_messages.login_success'),
            'token' => 'Bearer ' . $token,
        ], 200);
    }

    public function getUserData()
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
