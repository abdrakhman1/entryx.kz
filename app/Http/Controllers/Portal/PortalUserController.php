<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PortalUserController extends Controller
{
    public function dealer_login_form()
    {
        $user = Auth::user();
        // dd($user->role);
        // dd($user->hasRole('dealer'));
        if ($user && $user->hasRole('dealer')){
            return redirect()->route('portal.user.profile');
        } elseif ($user && $user->hasRole('sa')) {
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    public function dealer_login_form_submit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('dealer')) {
                return redirect()->route('portal.index')->withSuccess('Вы вошли');
            } elseif ($user->hasRole('sa')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('manager')) {
                // return redirect()->route('manager.dashboard');
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('storeman')) {
                return redirect()->route('storeman.index');
            }

            session()->flash('error', 'Ошибка входа');

            return redirect('/portal/login');
        }

        session()->flash('error', 'Ошибка входа');

        return redirect('/portal/login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('site.templates.portal.profile', compact('user'));
    }

    public function change_pass()
    {
        return view('site.templates.portal.change_pass');
    }

    public function change_pass_submit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'newpass' => 'required|min:3',
            'renewpass' => 'required|same:newpass',
        ]);

        $user = User::where('id', $user->id)->first();
        $user->password = Hash::make($request->newpass);
        $user->save();
        return redirect()->route('portal.user.profile')
                         ->with('success','Password changed successfully.');
    }

    public function addresses_create()
    {
        $user = Auth::user();
        return view('site.templates.portal.addresses_create', compact('user'));
    }

    public function addresses_store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'city' => 'required',
            'street' => 'required',
        ]);

        Address::create([
            'user_id' => $user->id,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        return redirect()->route('portal.user.profile')
                         ->with('success','Address created successfully.');
    }

    public function addresses_edit(Address $address)
    {
        $user = Auth::user();
        if ($user->id != $address->user_id){
            return redirect('/portal/profile');
        }
        return view('site.templates.portal.addresses_edit', compact('address'));
    }

    public function addresses_update(Address $address, Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'city' => 'required',
            'street' => 'required',
        ]);

        $address->update([
            'city' => $request->city,
            'street' => $request->street,
        ]);

        return redirect()->route('portal.user.profile')
                         ->with('success','Address created successfully.');
    }



}
