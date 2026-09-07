<?php

declare(strict_types=1);

namespace Models;

class User extends BaseModel
{
    protected string $table = 'users';

    public function fetchByUsername(string $username): array|false
    {
        $rows = $this->db()->exec(
            'SELECT * FROM ' . $this->table . ' WHERE username = :username',
            ['username' => $username],
        );
        return $rows[0] ?? false;
    }

    public function exists(string $username): bool
    {
        return $this->fetchByUsername($username) !== false;
    }

    public function create(string $username, string $email, string $passwordHash): int
    {
        return $this->insert([
            'username' => $username,
            'email' => $email,
            'password_hash' => $passwordHash,
        ]);
    }
}
