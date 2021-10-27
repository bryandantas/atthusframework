<?php

namespace App\Services\User;

use App\Enums\RolesType;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use App\Support\Message;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function allUsers(array $columns = ['*'])
    {
        return $this->userRepository->all($columns);
    }

    /**
     * @param array $data
     * @return RedirectResponse
     */
    public function createUser(array $data): RedirectResponse
    {
        $data['password'] = Str::random();
        $user = $this->userRepository->createUser($data);
        $user->assignRole(RolesType::USER);
        Message::flash('Usuário criado com sucesso!');

        return Redirect::route('admin.users.user', ['id' => $user->id]);
    }
}
