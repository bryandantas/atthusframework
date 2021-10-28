<?php

namespace App\Exceptions\User;

use Exception;

class UserDeleteException extends Exception
{
    protected $message = 'Erro ao excluir usuário, tente novamente';
}
