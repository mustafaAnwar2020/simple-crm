<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegiserController extends Controller
{
    public function register(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'password' =>'required|string|min:8',
            'c_password' => 'required|string|min:8|same:password'
        ]);
        if($validator->fails())
        {
            return $this->sendError($validator->errors(),'someting is wrong!');
        }
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole('user');
        $success['token'] = $user->createToken('123123asd')->accessToken;
        return $this->sendResponse($success,'user created successfully!');
    }
}
