<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => true
        ]);

        $user->assignRole($request->role);

        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Ditambahkan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;

        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);

        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function role(User $user)
    {
        $roles = Role::all()->pluck('name');

        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user->syncRoles($request->role);

        return redirect()->back()->with(['success' => 'Role sudah di set']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->role;

        $permissions = null;
        $hasPermissions = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {
            $getRole = Role::findByName($role);

            $hasPermissions = $getRole->permissions->pluck('name')->all();

            $permissions = Permission::all()->pluck('name');
        }

        return view('users.role-permission', compact('roles', 'permissions', 'hasPermissions'));
    }

    public function addPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);

        return redirect()->back();
    }

    public function setRolePermission(Request $request, $role)
    {
        $role = Role::findByName($role);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }
}
