<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token], 201);
    }

    public function login(UserAuthRequest $request)
    {
        $data = $request->validated();

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Data.Please try again'], 401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token], 200);

    }

    public function logout()
    {
    if (Auth::check())
    {
       Auth::user()->OauthAcessToken()->delete();
       return response(['Message:'=>'User Logout successfully','Code:'=>'1'], 205);
    }
    return response(['Message:'=>'You Should Login first to perform this process','Code:'=>'0'], 205);
    }


}
