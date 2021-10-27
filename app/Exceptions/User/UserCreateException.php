<?php

namespace App\Exceptions\User;

use Exception;

class UserCreateException extends Exception
{
    protected $message = 'Não foi possível criar o usuário, tente novamente mais tarde';
}
