<?php

namespace App\Shared\Exception;

class EntityNotFoundException extends BusinessException
{
    public function __construct($identifier, string $class)
    {
        parent::__construct(sprintf('Entity of type %s with identifier %s not found', $class, $identifier));
    }
}
