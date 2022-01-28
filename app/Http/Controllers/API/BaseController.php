<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$message){
        $response = [
            'success' => true,
            'data' => $result,
            'message'=> $message
        ];
        return response()->json($response,200);

    }

    public function sendError($error,$message=[],$code = 404){
        $response = [
            'success' => false,
            'data' => $error,
        ];
        if(!empty($message))
        {
            $response['message'] = $message;
        }
        return response()->json($response,$code);

    }

}
