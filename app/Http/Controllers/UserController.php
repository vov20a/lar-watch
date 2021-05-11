<?php

namespace App\Http\Controllers;

use App\Breadcrumbs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $breadcrumbs = Breadcrumbs::getBreadcrumbs('', 'register');
        return view('user.create', compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm()
    {
        $breadcrumbs = Breadcrumbs::getBreadcrumbs('', 'login');
        return view('user.login', compact('breadcrumbs'));
    }
    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'You are logged');
            if (Auth::user()->is_admin) {
                //идем в админку
                return redirect()->route('admin.index');
            } else {
                //иначе идем на главную
                return redirect()->home();
            }
        }
        //не прошли автор-цию
        return redirect()->back()->with('error', 'Incorrect login or password');
        // dd($request->all());
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
