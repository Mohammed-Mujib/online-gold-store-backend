<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;
use Nette\Utils\Json;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
{
    $request->authenticate();

    $user = $request->user();
    $token = $user->createToken("main")->plainTextToken;

    return response()->json([
        "data" => [
            // "user"  => new UseResource($user),
            "user" => $user,
            "token" => $token,
        ]
        ]);

}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete(); // this is work good

        return response()->json([
            "data" =>[
                "message" => "Logged out sucsessfully",
                "is_success" => true
            ]
        ], 200);
    }

}
