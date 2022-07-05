<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegiserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegiserRequest $request){
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' =>Hash::make($request->input('password')),
        ]);
        return response($user,Response::HTTP_CREATED);
    }
    public function login(Request $request){
      if (!Auth::attempt($request->only('email','password'))){
          return \response(['error invalid Credential!'],Response::HTTP_UNAUTHORIZED);//make status to frontend to aware him
      };//return t or f >> if it false
        $user =Auth::user(); //user logged in 👍
        $token=$user->createToken('token')->plainTextToken;//to make password hash in token

        $cookie=cookie('jwt',$token,60*24);//🌚 to login by just cookie and it will keep u login for 1 day 🌚//
        return \response(['jwt'=>$token])->withCookie($cookie);
    }
    public function user(Request $request)
    {
        return $request->user();
    }
    public function logout()
    {
        $cookie=Cookie::forget('jwt');//Look out and this will be a post request for logout needs to the user to be write authenticated to remove the cookie
        return \response(
            ['message'=>'success']
        )->withCookie($cookie);
    }

}
