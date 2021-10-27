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
}
