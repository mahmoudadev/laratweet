<?php

namespace App\Http\Controllers\API\v1;

use App\Tweet;
use Illuminate\Http\Request;
use App\Http\Requests\TweetStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Exception;


class TweetsController extends BaseController
{

    public function store(TweetStoreRequest $request)
    {

        $validated = $request->validated();
        $tweet = new Tweet();
        $tweet->content = $validated['content'];

        try {
            auth()->user()->tweets()->save($tweet);
            return $this->sendResponse($tweet->toArray(), 'created successfully');
        } catch (Exception $e) {
            return $this->sendError('Tweet could not be added', $e->getMessage(), $e->getCode());
        }

    }


    public function destroy(Tweet $tweet)
    {
        // IF we need to restrict this endpoint to destroy only
        // the tweets that owned by authenticated user

//        $tweet = auth()->user()->tweets()->find($id);
//
//        if (!$tweet) {
//            return $this->sendError('Tweet not found', null, 400);
//        }

        try {
            $tweet->delete();
            return $this->sendResponse($tweet, 'deleted successfully');
        } catch (Exception $e) {
            return $this->sendError('Tweet could not be deleted', $e->getMessage(), $e->getCode());
        }
    }
}
