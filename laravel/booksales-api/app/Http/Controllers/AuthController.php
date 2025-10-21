<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        // 1.setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        // 2.check validator
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        };

        // 3.create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 4.check success
        if($user){
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);
        };

        // 5.check failure
        return response()->json([
            'success' => false,
            'message' => 'User registration failed',
        ], 409);//conflict
    }

    public function login(Request $request){
        // 1.setup validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2.check validator
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        };

        // 3. get credentials
        $credentials = $request->only('email', 'password');

        // 4. ceck isFailed
        if (!$token = auth()-> guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);//unauthorized
        };
        // 5. check isSuccess
        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request){
        //try
        // 1. invalidate token
        // 2. check ifSuccess

        //catch
        // 1. check ifFailed

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully',
            ], 200);
        } catch(JWTException $e){
            return response()->json([
                'success' => false,
                'message' => 'Logout failed, please try again.',
            ], 500);

        }

    }

    
}
