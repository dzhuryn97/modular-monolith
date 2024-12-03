<?php

namespace App\Shared\Exception;

class BusinessException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
