<?php

namespace App\Http\Controllers\Admin;

use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UserInfoRequest;
use App\Http\Requests\Admin\UserPasswordRequest;
use App\Models\User;
use App\Services\User\UserService;
use App\Support\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        $persons = $this->userService->allUsers(['id', 'name', 'email']);

        return Inertia::render('Admin/Users/Users', [
            'title' => 'Usuários',
            'persons' => $persons,
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function create(CreateUserRequest $request): RedirectResponse
    {
        return $this->userService->createUser($request->all());
    }

    /**
     * @param UserInfoRequest $request
     * @return RedirectResponse
     */
    public function updateInfo(UserInfoRequest $request): RedirectResponse
    {
        return $this->userService->updateInfoUser($request->route('id'), $request->all());
    }

    /**
     * @param UserPasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UserPasswordRequest $request): RedirectResponse
    {
        return $this->userService->updatePasswordUser(auth()->user(), $request->all());
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        return $this->userService->deleteUser($request->route('id'));
    }
}
