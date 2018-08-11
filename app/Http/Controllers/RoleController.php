<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $role = Role::firstOrCreate(['name' => $request->name]);

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Ditambahkan']);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Dihapus']);
    }
}
