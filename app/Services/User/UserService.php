<?php

namespace App\Services\User;

use App\Enums\RolesType;
use App\Exceptions\User\UserCreateException;
use App\Exceptions\User\UserUpdateException;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use App\Support\Message;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @param array|string[] $columns
     * @return Collection
     */
    public function allUsers(array $columns = ['*']): Collection
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
        try {
            $user = $this->userRepository->createUser($data);
        } catch (UserCreateException $exception) {
            Message::flash($exception->getMessage());
            return Redirect::back();
        }
        $user->assignRole(RolesType::USER);
        Message::flash('Usuário criado com sucesso!');

        return Redirect::route('admin.users.user', ['id' => $user->id]);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return RedirectResponse
     */
    public function updateInfoUser(int $userId, array $data): RedirectResponse
    {
        try {
            $this->userRepository->updateInfoUser($userId, $data);
        } catch (UserUpdateException $exception) {
            Message::flash($exception->getMessage());
            return Redirect::back();
        }
        Message::flash('Informações atualizadas com sucesso');
        return Redirect::route('admin.users.user', ['id' => $userId]);;
    }
}
