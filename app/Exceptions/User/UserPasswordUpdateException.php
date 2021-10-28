<?php

namespace App\Exceptions\User;

use Exception;

class UserPasswordUpdateException extends Exception
{
    protected $message = 'Erro ao atualizar senha, tente novamente';
}
