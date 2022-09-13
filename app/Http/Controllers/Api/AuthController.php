<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registra o usuário por rota API.
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|unique:users,email',
            'password'  => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        $token = $user->createToken('tokenId' . $user->id)->plainTextToken;

        $response = [
            'user'      => $user,
            'token'     => $token
        ];

        return response($response, 201);
    }

    /**
     * Faz login do usuário por rota API.
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|string',
            'password'  => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if ( !$user || !Hash::check($request->password, $user->password) ){
            return response([
                'message' => 'Email ou senha estão incorretos.'
            ], 401);
        }

        $token = $user->createToken('tokenId' . $user->id)->plainTextToken;

        $response = [
            'user'      => $user,
            'token'     => $token
        ];

        return response($response, 201);
    }
}
