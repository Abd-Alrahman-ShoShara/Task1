<?php
namespace App\Http\Controllers\Api;


use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = new LoginDTO($request->validated());
        $result = $this->authService->login($dto);

        if (!$result) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'user' => $result['user'],
            'token' => $result['token'],
        ]);
    }

    
    public function register(RegisterRequest $request)
    {
        $dto = new RegisterDTO($request->validated()); 
        $result = $this->authService->register($dto); 
        
        
        return response()->json([
        'user' => $result['user'],
        'token' => $result['token'],
    ], 201);
}

public function logout(Request $request): JsonResponse
{
    $this->authService->logout($request->user());
    return response()->json(['message' => 'Logged out successfully']);
}
}
