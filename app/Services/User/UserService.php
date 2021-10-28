<?php

namespace App\Services\User;

use App\Enums\RolesType;
use App\Exceptions\User\UserCreateException;
use App\Exceptions\User\UserDeleteException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserPasswordUpdateException;
use App\Exceptions\User\UserUpdateException;
use App\Models\User;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use App\Support\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
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
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        try {
            return $this->userRepository->find($id);
        } catch (UserNotFoundException $exception) {
            Message::flash($exception->getMessage(), 'error');
            return null;
        }
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
            Message::flash($exception->getMessage(), 'error');
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
            Message::flash($exception->getMessage(), 'error');
            return Redirect::back();
        }
        Message::flash('Informações atualizadas com sucesso');
        return Redirect::route('admin.users.user', ['id' => $userId]);;
    }

    /**
     * @param User $user
     * @param array $data
     * @return RedirectResponse
     */
    public function updatePasswordUser(User $user, array $data): RedirectResponse
    {
        if (!Hash::check($data['password'], $user->getAuthPassword())) {
            Message::flash('Senha atual informada está incorreta', 'error');
            return Redirect::back();
        }

        $data['password'] = Hash::make($data['password']);
        try {
            $this->userRepository->updateInfoUser($user->id, $data);
        } catch (UserPasswordUpdateException $exception) {
            Message::flash($exception->getMessage(), 'error');
            return Redirect::back();
        }
        Message::flash('Senha atualizada com sucesso');
        return Redirect::route('admin.users.user', ['id' => $user->id]);
    }

    /**
     * @param int $userId
     * @return RedirectResponse
     */
    public function deleteUser(int $userId): RedirectResponse
    {
        try {
            $this->userRepository->deleteUser($userId);
        } catch (UserDeleteException $exception) {
            Message::flash($exception->getMessage(), 'error');
            return Redirect::back();
        }
        Message::flash('Usuário excluído com sucesso');
        return Redirect::route('admin.users');
    }
}
