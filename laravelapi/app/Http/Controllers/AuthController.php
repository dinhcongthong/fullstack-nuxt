<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    { }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['There is something wrong! We could not verify details']
                ]
            ], 422);
        }
        // return 
        return response()->json(['token' => $request->user()->createToken('api_token')->plainTextToken]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function register(Request $request)
    {
        return response()->json([$request->all()]);
    }
}
