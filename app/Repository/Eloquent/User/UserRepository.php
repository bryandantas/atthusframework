<?php


namespace App\Repository\Eloquent\User;


use App\Exceptions\User\UserCreateException;
use App\Exceptions\User\UserUpdateException;
use App\Models\User;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use App\Support\Message;
use Illuminate\Database\Eloquent\Model;
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
     * @return User
     * @throws UserUpdateException
     */
    public function updateInfoUser(int $userId, array $data): User
    {
        try {
            /** @var User $user */
            $user = $this->update($userId, $data);
            return $user;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            throw new UserUpdateException();
        }
    }
}
