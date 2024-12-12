<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user(Request $request)
    {
        return $request->user();
    }

    public function admin_login_form()
    {
        return view('login');
    }

    public function admin_login_form_submit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('dealer')) {
                return redirect()->route('portal.user.profile')->withSuccess('Вы вошли');
            } elseif ($user->hasRole('sa')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('storeman')) {
                return redirect()->route('storeman.index');
            }

            return redirect('/portal/login');
        }

        return redirect('/portal/login')->withSuccess('Login details are not valid');


        // $user = User::where('email', $request->email)->first();
        // if($user != null && Hash::check($request->password, $user->password)) { 
        //     session(
        //         [
        //             'name' => $user->name,
        //         ]
        //     );
        //     $credentials = $request->only('email', 'password');
        //     Auth::attempt($credentials);

        //     return redirect('/admin/dashboard');
        // } else {
        //     return redirect('/admin_login');
        // }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function user_logout()
    {
        session()->flush();
        return redirect('/user/login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function registration_form()
    {
        return view('user.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:2',
            'repassword' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            session()->flash('error', 'Пользователь с таким email уже зарегистрирован');
            return redirect('/user/registration');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        session()->flash('success', 'Вы успешно зарегистрировались');
        return redirect('/user/login');
    }

    public function user_login_form()
    {
        return view('user.login');
    }

    public function user_login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            session()->flash('error', 'Ошибка входа');
            return redirect('/user/login');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/user/profile')
                        ->withSuccess('Вы вошли');
        }

        return redirect('/user/login')->withSuccess('Login details are not valid');
    }

    public function user_profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }
}