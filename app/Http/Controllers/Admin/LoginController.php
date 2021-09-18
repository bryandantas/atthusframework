<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Support\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Login', [
            'title' => 'Login | Atthus Framework'
        ]);
    }

    public function login(LoginRequest $request)
    {
        $remember = $request->get('remember');

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
            if(Auth::user()->can(PermissionType::LOGIN_ADMIN)){
                Message::flash('Login realizado com sucesso');
                return Redirect::route('admin.home');
            }else{
                Message::flash('Você não possui permissão para acessar esta área', 'error');
                return Redirect::back();
            }

        }

        Message::flash('Email e senha não conferem', 'error');
        return Redirect::back();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Message::flash('Saiu com sucesso');
        return Redirect::route('admin.login');
    }
}
