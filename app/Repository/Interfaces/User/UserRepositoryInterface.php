<?php


namespace App\Repository\Interfaces\User;


use App\Models\User;
use App\Repository\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
interface UserRepositoryInterface extends EloquentRepositoryInterface {
    /**
     * Create a User
     *
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data): User;

    /**
     * Update a User
     *
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function updateInfoUser(int $userId, array $data): bool;

    /**
     * Delete a User
     *
     * @param int $userId
     * @return mixed
     */
    public function deleteUser(int $userId): bool;

    public function find(int $id): User;
}
