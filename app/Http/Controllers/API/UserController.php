<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Profile;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TasksResource;
use App\Http\Resources\userResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $user = User::all();
        return $this->sendResponse(userResource::collection($user),'All users retrieved!');
    }

    public function show(User $user){
        $project = Project::where('user_id',$user->id)->first();
        $task = Task::where('user_id',$user->id)->first();
        return [
            'user'=> $this->sendResponse(new userResource($user),'User\'s data retrieved successfully!'),
            'project'=> $this->sendResponse(new ProjectResource($project),'User\'s projects retrieved successfully!'),
            'task'=> $this->sendResponse(new TasksResource($task),'User\'s tasks retrieved successfully!'),
        ];
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'password' =>'required|string|min:8',
            'role'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'address' =>$request->address,
            'phone'=>$request->phone,
            'contact'=>$request->contact
        ]);
        $user->assignRole($request->role);
        return $this->sendResponse(new userResource($user),'User created successfully!');
    }

    public function update(Request $request,User $user){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'password' =>'required|string|min:8',
            'role'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->phone = $request->phone;
        $user->profile->address = $request->address;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->role);
        return $this->sendResponse(new userResource($user),'User updated successfully!');
    }

    public function destroy(User $user){
        $user->delete($user->id);
        return $this->sendResponse(new userResource($user),'User deleted successfully!');
    }
}
