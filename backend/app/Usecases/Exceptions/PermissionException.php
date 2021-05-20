<?php

namespace App\Usecases\Exceptions;

use Exception;

class PermissionException extends Exception
{
    public function __construct($message = 'This action is unauthorized.', $code = 403, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
