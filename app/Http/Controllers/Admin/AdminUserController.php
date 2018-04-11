<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function list() {
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function get_user($id) {
        $user = User::find($id);
        $roles = Role::all()->pluck('name');
        return view('admin.user', compact('user','roles'));
    }

    public function editUser(Request $request, $id) {
        $user = User::where('email','=',$request->get('email'))->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password') != null) {
            $user->password = bcrypt($request->get('password'));
        }

        if (!$user->hasRole($request->get('role'))) {
            $user->attachRole(Role::where('name','=',$request->get('role'))->first());
        }
        $user->save();
        return redirect()->back()->with('status','Изменения сохранены');
    }

    public function rolesForm() {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.roles', compact('roles','permissions'));
    }

    public function changeRolesPermission(Request $request) {
        // получение имен ролей
        $names = Role::all()->pluck('name');

        foreach ($names as $name) {
            $role_obj = Role::where('name','=',$name)->first();

            $role_obj->attachPermissions($request->get($name));
        }

        echo 'ok';
    }
}
