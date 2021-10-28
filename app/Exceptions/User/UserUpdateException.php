<?php

namespace App\Exceptions\User;

use Exception;

class UserUpdateException extends Exception
{
    protected $message = 'Não foi possível atualizar o usuário, tente novamente mais tarde';
}
