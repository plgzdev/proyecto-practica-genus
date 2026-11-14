<?php

declare(strict_types=1);

namespace App\Contracts;

interface UserModelInterface
{
    public function findByEmail(string $email): ?array;
}