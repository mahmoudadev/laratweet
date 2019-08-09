<?php

namespace App\Http\Controllers\API;

use App\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Exception;


class TweetsController extends BaseController
{

    public function store(Request $request)
    {
        $messages = [
            'max' => ':attribute Field must be equal or less than :max characters.',
        ];

        $this->validate($request, [
            'content' => 'required|max:140',
        ], $messages);

        $tweet = new Tweet();
        $tweet->content = $request->get('content');

        try {
            auth()->user()->tweets()->save($tweet);
            return $this->sendResponse($tweet->toArray(), 'created successfully');
        } catch (Exception $e) {
            return $this->sendError('Tweet could not be added', $e->getMessage(), $e->getCode());
        }

    }


    public function destroy($id)
    {
        $tweet = auth()->user()->tweets()->find($id);

        if (!$tweet) {
            return $this->sendError('Tweet not found', null, 400);
        }

        try {
            $tweet->delete();
            return $this->sendResponse($tweet, 'deleted successfully');
        } catch (Exception $e) {
            return $this->sendError('Tweet could not be deleted', $e->getMessage(), $e->getCode());
        }
    }
}
