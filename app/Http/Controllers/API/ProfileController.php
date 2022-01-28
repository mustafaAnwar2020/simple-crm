<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $id =Auth::id();
        $profile = Profile::where('user_id',$id)->first();
        // dd($profile);
        return $this->sendResponse(new ProfileResource($profile),'your account is ready');
    }

    public function update(Request $request , Profile $profile){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' =>'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $user = Auth::user();
        $id=Auth::id();
        $user->name = $input['name'];
        $user->save();
        $user->profile->address = $input['address'];
        $user->profile->phone = $input['phone'];
        $user->profile->contact = $input['contact'];
        $user->profile->save();
        $profile = Profile::where('user_id',$id)->first();
        return $this->sendResponse(new ProfileResource($profile),'Profile updated successfully!');
    }

    public function updatePassword(Request $request,Profile $profile)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'oldPassword'=>'required|min:8|string',
            'newPassword' =>'required|min:8|string',
            'confirmPassword' =>'required|min:8|string|same:newPassword'
        ]);
        $user = Auth::user();
        $id = Auth::id();
        $check=Hash::check($request->oldPassword,$user->password);
        if($check){
            $user->password = Hash::make($request->newPassword);
            $user->save();
        }
        $profile = Profile::where('user_id',$id)->first();
        return $this->sendResponse(new ProfileResource($profile),'Password updated successfully!');
    }
}
