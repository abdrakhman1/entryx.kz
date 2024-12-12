<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index')
                         ->with('success','User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')
                         ->with('success','User updated successfully.');
    }

    public function destroy(User $user)
    {
        // if ($user->id != 1){
        //     $user->delete();
        // }

        return redirect()->route('admin.users.index')
                         ->with('success','User deleted successfully.');
    }
}
