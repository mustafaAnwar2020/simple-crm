<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $user = User::paginate(20);
        return view('users.index')->with('user',$user);
    }

    public function show(User $user){
        return view('users.show')->with('user',$user);
    }

    public function create(){
        return view('users.create');
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
        return redirect()->route('users.index');
    }
    public function edit(User $user){
        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, User $user){
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->phone = $request->phone;
        $user->profile->address = $request->address;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        return redirect()->route('users.index');
    }

    public function destroy(User $user){
        $user->delete($user->id);
        return redirect()->route('users.trash');
    }
}
