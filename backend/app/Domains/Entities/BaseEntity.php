<?php

namespace App\Domains\Entities;

use RuntimeException;

class BaseEntity
{
    protected string $created_at;
    protected string $updated_at;

    protected function illegalAssignment(string $class, string $propety, $value)
    {
        throw new RuntimeException("Illegal assignment for $class.$propety: $value");
    }
}
