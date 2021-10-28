<?php


namespace App\Repository\Eloquent\User;


use App\Exceptions\User\UserCreateException;
use App\Exceptions\User\UserDeleteException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserUpdateException;
use App\Models\User;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 * @package App\Repository\Eloquent\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


    /**
     * Create a User
     *
     * @param array $data
     * @return User
     * @throws UserCreateException
     */
    public function createUser(array $data): User
    {
        try {
            /** @var User $user */
            $user = $this->create($data);
            return $user;
        } catch (QueryException $exception){
            Log::error($exception->getMessage());
            throw new UserCreateException();
        }
    }

    /**
     * @param int $userId
     * @param array $data
     * @return bool
     * @throws UserUpdateException
     */
    public function updateInfoUser(int $userId, array $data): bool
    {
        try {
            return $this->update($userId, $data);
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            throw new UserUpdateException();
        }
    }

    /**
     * @param int $userId
     * @return bool
     * @throws UserDeleteException
     */
    public function deleteUser(int $userId): bool
    {
        try {
            return $this->deleteById($userId);
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            throw new UserDeleteException();
        }
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function find(int $id): User
    {
        try {
            /** @var User $user */
            $user = $this->findById($id);
            return $user;
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            throw new UserNotFoundException();
        }
    }
}
