<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRegisterRequest;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UsersRegisterRequest $request)
    {
        $imgPath = $request->file('image')->store('avatars');

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['image'] = $imgPath;
        $user = User::create($data);
        $response['token'] = $user->createToken('laratweet')->accessToken;
        $response['name'] = $user->name;

        return $this->sendResponse($response, 'User registered Successfully');

    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('laratweet')->accessToken;
            return $this->sendResponse(['token' => $token], 'Logged in successfully');

        } else {
            return $this->sendError("Unauthorized", null, 401);
        }


    }


}
