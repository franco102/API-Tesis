<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // Register  EndPoint
    public function register(Request $request)
    {   //---->Validation
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);
        //---->Logical 
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        // $user->email_verified_at=0;
        $user->remember_token=Hash::make($request->password);
        // return response()->json($user);
        $user->save();
        //Response
        return response($user,Response::HTTP_CREATED);
    }
    // Login EndPoint
    public function login(Request $request)
    {
        //---->Validation
        $validation=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        //---->Logical 
        if (Auth::attempt($validation)) {
            $user=Auth::user();
            $token=$user->createToken('token')->plainTextToken;
            $cookie=cookie('cookie_token',$token,6*24);
            //Response
            return response (["token"=>$token],Response::HTTP_OK)->withoutCookie($cookie);
        }else{
            //Response
            return response(["message"=>"Invalid credentials"],Response::HTTP_UNAUTHORIZED);
        }
    }
    //Get data User EndPoint
    public function getUser()
    {
        return response ([
            "message"=>"userProfile_OK",
            "userData"=>auth()->user()
        ],Response::HTTP_OK);
    }
    //Logout EndPoint
    public function logout()
    {
        $cookie=Cookie::forget('cookie_token');
        return response ([
            "message"=>"logout_OK",
        ],Response::HTTP_OK)->withCookie($cookie);
    }
}
