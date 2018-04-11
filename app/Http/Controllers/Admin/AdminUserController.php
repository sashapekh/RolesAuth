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
        $user = User::where('id','=',$id)->first();
//        dd($request->all());
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
        // Удаляю все здачения в таблице
        DB::table('permission_role')->delete();
        // получение имен ролей
        $roles = Role::all()->pluck('name');

        foreach ($roles as $role) {
            $role_obj = Role::where('name','=',$role)->first();
            $permissions_array = $request->get($role);
            //Проверяю или  request->value != null
            if ($request->get($role) != null) {
                // назначаю права ролям
                $role_obj->attachPermissions($permissions_array);
            }
        }
        return redirect()->back();
    }
}
