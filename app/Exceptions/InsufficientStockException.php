<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InsufficientStockException extends Exception
{
    public function __construct($message = 'Insufficient stock available.', $code = Response::HTTP_CONFLICT)
    {
        parent::__construct($message, $code);
    }
}
