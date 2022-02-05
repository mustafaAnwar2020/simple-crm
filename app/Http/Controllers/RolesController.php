<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

     function __construct()
     {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
         $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
     }
    public function index()
    {
        $roles = Role::paginate(5);
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::all();
        return view('roles.create')->with('permission', $permission);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        $roles = Role::create([
            'name' => $request->name
        ]);

        $roles->syncPermissions($request->permission);
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where('role_has_permissions.role_id', $role->id)->get();
        return view('roles.show')->with('role', $role)->with('rolePermissions', $rolePermissions);
    }


    public function edit(Role $role)
    {
        $permission = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit')->with('role',$role)->with('permission',$permission)->with('rolePermissions',$rolePermissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete($role->id);
        return redirect()->route('roles.index');
    }
}
