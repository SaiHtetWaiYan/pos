<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Userinfo;
use App\Models\Brand;
use App\Models\Category;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator =$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            ],
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $userInfo = Userinfo::create([
            'user_id' => $user->id
        ]);
        return response()->json(['token' => $token,'user' => $user,'userInfo' => $userInfo , 'message' => 'Successfully registered'],200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token=  $user->createToken('auth_token')->plainTextToken;

            $userInfo = Userinfo::where('user_id', $user->id)->first();
            return response()->json(['token' => $token,'user' => $user,'userInfo' => $userInfo , 'message' => 'Login Successfully'],200);
        }
        else{
            return response()->json(['error'=>'Ooops! Something Wrong.'], 401);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::where('id',$request->id)->first();

        $validator= $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user->update([
            'name' => $validator['name']
        ]);

        if (Auth::user()->email == $request->email)
        {
            $validator =$request->validate([
                'email' => 'required|string|email|max:255',
            ]);
            $user->update([
                'email' => $validator['email']
            ]);
        }
        else{
            $validator = $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            $user->update([
                'email' => $validator['email']
            ]);
        }

        if ($request->photo)
        {
            $request->validate([
                'photo' => 'mimes:jpg,jpeg,png'
            ]);
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('users'), $imageName);
            $user->update([
                'photo' => $imageName
            ]);
        }

        if($request->new_password || $request->current_password)
        {
            $request->validate([
                'current_password' => 'required',
            ]);
            if(!Hash::check($request->current_password, auth()->user()->password)){
                return response()->json(["passwordError"=>"Old Password Doesn't match!" ],401);
            }
            $request->validate([
                'new_password' => ['required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                ],
            ]);

            $user->update(['password'=> Hash::make($request->new_password)]);
        }
        return response()->json(['message'=> 'Profile Update Successfully' , 'user' => $user], 200);


    }

    public function personalInfoUpdate(Request $request)
    {
        $userInfo = Userinfo::where('user_id', $request->user_id)->first();
        $userInfo->update([
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'phone_number' => $request->phone_number,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country
        ]);

        return response()->json(['message' => 'Personal Info update successfully' , 'userInfo' => $userInfo], 200);
    }

    public function AccountDelete(Request $request)
    {
        if(!Hash::check($request->password, auth()->user()->password)){
            return response()->json(["passwordError"=>"Password Doesn't match!" ],401);
        }
        Userinfo::where('user_id', $request->id)->delete();
        Brand::where('user_id',$request->id)->forceDelete();
        Category::where('user_id',$request->id)->forceDelete();
        auth()->user()->tokens()->delete();
        User::find($request->id)->forceDelete();

        return response()->json(['message' => 'Successfully account deleted']);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }




}
