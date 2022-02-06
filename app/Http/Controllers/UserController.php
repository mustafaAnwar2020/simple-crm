<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        $user = User::paginate(20);
        return view('users.index')->with('user',$user);
    }

    public function show(User $user){
        $project = Project::where('user_id',$user->id)->get();
        $task = Task::where('user_id',$user->id)->get();
        return view('users.show')->with('user',$user)->with('projects',$project)->with('tasks',$task);
    }

    public function create(){
        $role=Role::all();
        return view('users.create')->with('role',$role);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'password' =>'required|string|min:8',
            'role'=>'required'
        ]);
        // dd($request);
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
        return redirect()->route('users.index');
    }
    public function edit(User $user){
        $role=Role::all();
        $userRole = DB::table('model_has_roles')->where('model_id',$user->id)->pluck('role_id','role_id')->first();
        // dd($userRole);
        return view('users.edit')->with('user',$user)->with('role',$role)->with('userRole',$userRole);
    }

    public function update(Request $request, User $user){
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'role' =>'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->phone = $request->phone;
        $user->profile->address = $request->address;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->role);
        return redirect()->route('users.index');
    }

    public function destroy(User $user){
        $user->delete($user->id);
        return redirect()->route('users.trash');
    }
}
