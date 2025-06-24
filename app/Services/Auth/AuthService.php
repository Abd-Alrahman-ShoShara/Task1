<?php
namespace App\Services\Auth;

use App\DTOs\Auth\LoginDTO;
use Illuminate\Support\Facades\Auth;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthService
{
    public function login(LoginDTO $dto): ?array
    {
        if (!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])) {
            return null;
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function register(RegisterDTO $dto): array
{
    $user = User::create([
        'name' => $dto->name,
        'email' => $dto->email,
        'password' => Hash::make($dto->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return [
        'user' => $user,
        'token' => $token,
    ];
}

    public function logout($user): void
    {
        $user->tokens()->delete();
    }
}