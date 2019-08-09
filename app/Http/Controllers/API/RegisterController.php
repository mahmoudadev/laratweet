<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
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
        $data['password'] =bcrypt($data['password']);
        $data['image'] = $imgPath;
        $user = User::create($data);
        $response['token'] = $user->createToken('laratweet')->accessToken;
        $response['name'] =  $user->name;

        return $this->sendResponse($response, 'User registered Successfully');

    }
}
