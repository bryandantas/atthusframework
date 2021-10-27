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
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class LoginController extends Controller
{
    /**
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Login', [
            'title' => 'Login | Atthus Framework'
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {
            if(Auth::user()->can(PermissionType::LOGIN_ADMIN)){
                $request->session()->regenerate();
                Message::flash('Login realizado com sucesso');

                return redirect()->intended(route('admin.home'));
            }else{
                Message::flash('Você não possui permissão para acessar esta área', 'error');
                return Redirect::back();
            }

        }

        Message::flash('Email e senha não conferem', 'error');
        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Message::flash('Saiu com sucesso');
        return Redirect::route('admin.login');
    }
}
