<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;

class UserController extends Controller
{

    /**
     * Users retrieve function
     *
     * @return void
     */
    public function index(){
        return response()->json(User::get(), 200);
    }

    /**
     * User login function
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($credentials)) {
            $status = 200;
            $response = [
                'token' => Auth::user()->createToken('xstore')->accessToken,
                'user' => Auth::user()
            ];
        }

        return response()->json($response, $status);
    }

    /**
     * User show function
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        return response()->json($user,200);
    }
}
