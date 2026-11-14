<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\UserModelInterface;
use PDO;

class UserModel implements UserModelInterface
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT id, name, email, password, role FROM users WHERE email = :email LIMIT 1'
        );
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        return $user !== false ? $user : null;
    }
}