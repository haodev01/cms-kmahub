<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh']]);
    }
    public function login(LoginRequest $request)
    {   

        $credentials = request(['email', 'password']);
        try{
            if (!$access_token = Auth::guard('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $user = User::where('email', $credentials['email'])->first();
            $data = [
                'sub' => $user->id,
                'expt' => time() + config('jwt.refresh_ttl'),
            ];
            $refresh_token = JWTAuth::getJWTProvider()->encode($data);

            return $this->success([
                'access_token'=> $access_token,
                'refresh_token'=> $refresh_token,
                'user'=> $user
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function register(Request $request)
    {
        $credentials = [
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'name'=> $request->name,
            'username'=> $request->username
        ];
        try {
            $user = User::create($credentials);
            $access_token = Auth::guard('api')->login($user);
            $refresh_token = $this->createRefreshToken();
            return $this->success([
                'access_token'=> $access_token,
                'refresh_token'=> $refresh_token,
                'user'=> $user
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function refresh (Request $request) {
        $refresh_token = $request->refresh_token;
        try {
            $decode= JWTAuth::getJWTProvider()->decode($refresh_token);
            $user = User::findOrFail($decode['sub']);
            if(!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }
            Auth::guard('api')->invalidate();
            $access_token = Auth::guard('api')->login($user);
            $refresh_token = $this->createRefreshToken();
            return $this->success([
                'access_token'=> $access_token,
                'refresh_token'=> $refresh_token,
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
        
    }
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }
    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->success(['message'=> 'Successfully logged out']);
    }
    public function createRefreshToken() {
        $data = [
            'sub' => Auth::guard('api')->user()->id,
            'expt' => time() + config('jwt.refresh_ttl'),
        ];
        return  JWTAuth::getJWTProvider()->encode($data);
    }
}
