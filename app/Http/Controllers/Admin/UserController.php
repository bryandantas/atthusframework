<?php

namespace App\Http\Controllers\Admin;

use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UserInfoRequest;
use App\Http\Requests\Admin\UserPasswordRequest;
use App\Models\User;
use App\Support\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $persons = User::get(['id', 'name', 'email']);

        return Inertia::render('Admin/Users/Users', [
            'title' => 'Usuários',
            'persons' => $persons,
        ]);
    }

    public function create(CreateUserRequest $request)
    {
        return UserBusiness::create($request->all());
    }

    public function updateInfo(UserInfoRequest $request)
    {
        $user = User::find($request->route('id'));
        return UserBusiness::updateInfo($user, $request->all());
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        $user = User::find($request->route('id'));
        return UserBusiness::updatePassword($user, $request->all());
    }

    public function view(Request $request)
    {
        $user = User::find($request->route('id'));

        if(!$user){
            Message::flash('Usuário não encontrado', 'error');
            return Redirect::route('admin.users');
        }

        return Inertia::render('Admin/Users/User', [
            'title' => 'Editar Usuário',
            'user' => $user,
        ]);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->route('id'));
        return UserBusiness::delete($user);
    }
}
