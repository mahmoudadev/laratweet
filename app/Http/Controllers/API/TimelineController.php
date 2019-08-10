<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

class TimelineController extends BaseController
{
    /*
     * Handle timeline data
     *
     */

    public function index()
    {
        $response = [];
        $followings = auth()->user()->followings;

        foreach ($followings as $following) {
            $tweets = $following->tweets;
            if (!empty($tweets)) {
                foreach ($tweets as $tweet) {
                    $response [] = $tweet;
                }
            }
        }

        return $this->sendResponse($response, 'data retrieved successfully');

    }
}
