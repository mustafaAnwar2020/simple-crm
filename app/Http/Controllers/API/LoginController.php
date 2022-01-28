<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('randomString')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success,'user logged in successfully!');
        }
        else
        {
            return $this->sendError(['error'=>'user Unauthorized'],"wrong or invalid credintials");
        }
    }
}
