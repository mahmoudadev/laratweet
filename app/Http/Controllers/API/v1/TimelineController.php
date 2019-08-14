<?php

namespace App\Http\Controllers\API\v1;

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
        $userTweets = auth()->user()->tweets;
        // adding auth user tweets to the response
        if (!empty($userTweets)) {
            foreach ($userTweets as $userTweet) {
                $response [] = $userTweet;
            }
        }

        $followings = auth()->user()->followings;
        // adding user followings tweets to the response
        foreach ($followings as $following) {
            $tweets = $following->tweets;
            if (!empty($tweets)) {
                foreach ($tweets as $tweet) {
                    $response [] = $tweet;
                }
            }
        }

        if (!empty($response)) {
            return $this->sendResponse($response, 'data retrieved successfully');
        }else{
            return $this->sendResponse($response, 'Empty!, there are no tweets yet');
        }
    }
}
