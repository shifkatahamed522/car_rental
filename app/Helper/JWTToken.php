<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    // Create JWT Token
    public static function createToken($userId, $userEmail, $role)
    {
        $key = env('JWT_SECRET');

        $payload = [
            'iss' => 'Laravel',
            'iat' => time(),
            'exp' => time() + 60 * 60, // 1 hour expiration
            'user_id' => $userId,
            'user_email' => $userEmail,
            'role' => $role
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    // Verify JWT Token
    public static function verifyToken($token)
    {
        if (!$token) {
            return "unauthorized";
        }

        try {
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Ensure token has not expired
            if ($decoded->exp < time()) {
                return response()->json(['error' => 'Token expired'], 401);
            }

            return $decoded; // ✅ Returns decoded token object
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
