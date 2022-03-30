<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'Get all users success',
            'users' => User::all()
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'User not found!'
            ],404);
        }
        return response()->json([
            'status' => true,
            'message' => 'User found success!', 
            'user' => $item
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = User::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'User not found!'
            ],404);
        }

        $request->validate([
            'email' => 'sometimes|required|string|unique:users,email',
            'login' => 'sometimes|required|string',
            'password' => 'sometimes|required|string|min:8',
            'number' => 'sometimes|required|string',
            'uid' => 'sometimes|required|string',
        ]);

        $item->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'User update success!'
        ], 200);
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',
            'login' => 'required|string',
            'password' => 'required|string|min:8',
            'number' => 'required|string',
            'uid' => 'required|string',
        ]);

        $user = User::create([
            'login' => $fields['login'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'status' => 'Register to app!',
            'number' => $fields['number'],
            'uid' => $fields['uid'],
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $res = [
            'status' => true,
            'message' =>'Register success!',
            'user' => User::find($user->id),
            'token' => $token
        ];

        return response($res,201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'uid' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('uid', $fields['uid'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ],401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        $res = [
            'status' => true,
            'message' => 'Login success!',
            'user' => User::find($user->id),
            'token' => $token
        ];

        return response($res,201);
    }

    public function logout()
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });    
    
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);

    }

}
