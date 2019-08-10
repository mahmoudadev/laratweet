<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
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
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }


        $imgPath = $request->file('image')->store('avatars');

        $data = $request->all();
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
