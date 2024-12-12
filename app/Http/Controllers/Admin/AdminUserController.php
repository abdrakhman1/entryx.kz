<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
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
            'role_id' => 'required',
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
        DB::transaction(function () use ($user) {
            if ($user->cart != null){
                foreach($user->cart as $cart){
                    foreach($cart->items as $cartItem){
                        $cartItem->delete();
                    }
                    $orders = Order::where('cart_id', $cart->id)->get();
                    foreach($orders as $order){
                        $order->delete();
                    }
                    $cart->delete();
                }
            }
        });

        if ($user->id != 1){
            $user->delete();
        }

        return redirect()->route('admin.users.index')
                         ->with('success','User deleted successfully.');
    }

    public function change_pass(User $user)
    {
        return view('admin.users.change_pass', compact('user'));
    }

    public function change_pass_submit(Request $request, User $user)
    {
        $request->validate([
            'newpass' => 'required|min:3',
            'renewpass' => 'required|same:newpass',
        ]);

        $user->password = Hash::make($request->newpass);
        $user->save();
        return redirect()->route('admin.users.show', $user)
                         ->with('success','Password changed successfully.');
    }
}
