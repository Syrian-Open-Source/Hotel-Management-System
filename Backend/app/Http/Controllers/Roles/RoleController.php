<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index',]]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-show', ['only' => ['show']]);
        $this->middleware('permission:role-edit', ['only' => ['update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response(['role' => $roles], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        $permissions = [$request->permissions];

        foreach ($permissions as $permission)
        {
            $role->syncPermissions($permission);
        }

        return response(['Message:'=>'Role Created successfully','Code:'=>'1','role' => $role], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)->get();

        return response(['Message:'=>'Role info fetched successfully','Code:'=>'1','role' => $role, 'Role Permissions' => $rolePermissions], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::find($id);

        if (empty($request))
        {
            return response(['Message:'=>'You Cant send an empty request','Code:'=>'-1'], 400);
        }

        if (!empty( $request->input('name'))) {
            $role->name = $request->input('name');
        }

        $role->save();

        if (!empty($request->input('permissions'))) {

            $permissions = [$request->permissions];

            foreach ($permissions as $permission)
            {
                $role->syncPermissions($permission);
            }
        }

        return response(['Message:'=>'Role edited successfully','Code:'=>'1','role' => $role], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        return response(['Message:'=>'Role deleted successfully','Code:'=>'1'], 204);

    }
}
