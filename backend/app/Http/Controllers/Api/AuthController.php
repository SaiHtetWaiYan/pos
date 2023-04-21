<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:8',
//            'password' => ['required', 'confirmed', Password::min(8)
//                ->mixedCase()
//                ->letters()
//                ->numbers()
//                ->symbols()
//                ->uncompromised(),
//            ],
        ]);

        if($validator->fails()){
            return response()->json(['error', $validator->errors()],401);
        }

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['$token' => $token,'user' => $user, 'message' => 'Successfully registered'],200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token=  $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token,'user' => $user, 'message' => 'Login Successfully'],200);
            //return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return response()->json(['error'=>'Ooops! Something Wrong.'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }




}
