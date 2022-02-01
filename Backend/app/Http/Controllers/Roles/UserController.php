<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response(['user' => $user], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $user->assignRole($request->input('roles_name'));

        return response(['Message:'=>'User Created successfully','Code:'=>'1','user' => $user], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response(['Message:'=>'User info fetched successfully','Code:'=>'1','user' => $user], 200);
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
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles_name' => 'required'
        ]);

        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles_name'));

        return response(['Message:'=>'User info edited successfully','Code:'=>'1','user' => $user], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response(['Message:'=>'User deleted successfully','Code:'=>'1'], 204);

    }
}
