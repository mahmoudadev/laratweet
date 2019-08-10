<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;


class UsersFollowController extends BaseController
{

    /*
     * Handle following users each other
     * @param $user object
     */

    public function follow(User $user)
    {

        try {
            if(auth()->user()->id === $user->id){
                return $this->sendError('you can not follow yourself');
            }
            auth()->user()->follow($user);
            return $this->sendResponse(null, 'You now followed ' . $user->name);
        } catch (\Exception $e) {
            return $this->sendError('something went wrong', $e->getMessage(), $e->getCode());
        }
    }
}
