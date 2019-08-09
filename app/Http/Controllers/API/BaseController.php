<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /*
     * send success response
     */

    public function sendResponse($result , $message){
        $response = [
            'success' => true,
            'data' => $result,
            'message'=> $message,
        ];

        return response()->json($response, 200);
    }

    /*
     * send error response
     */

    public function sendError($error, $errorMessages = [], $code = 400 ){

        $response =[
            'success' => false,
            'message' => $error,

        ];

        if(!empty($errorMessages)){
                $response['errors'] = $errorMessages;
        }


        return response()->json($response, $code);

    }


}
