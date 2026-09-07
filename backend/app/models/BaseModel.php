<?php

declare(strict_types=1);

namespace Models;

use DB\SQL;

abstract class BaseModel
{
    /** Table name, must be set by subclasses. */
    protected string $table = '';

    final protected function db(): SQL
    {
        return Database::connection();
    }

    public function fetchAll(): array
    {
        return $this->db()->exec(
            'SELECT * FROM ' . $this->table,
        );
    }

    public function fetchById(int $id): array|false
    {
        $rows = $this->db()->exec(
            'SELECT * FROM ' . $this->table . ' WHERE id = :id',
            ['id' => $id],
        );
        return $rows[0] ?? false;
    }

    public function insert(array $data): int
    {
        $columns = array_keys($data);
        $this->db()->exec(
            sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', $columns),
                implode(', ', array_map(static fn ($c) => ':' . $c, $columns)),
            ),
            $data,
        );
        return (int) $this->db()->pdo()->lastInsertId();
    }

    public function update(int $id, array $data): int
    {
        $assignments = implode(', ', array_map(
            static fn ($c) => $c . ' = :' . $c,
            array_keys($data),
        ));
        $data['id'] = $id;
        $result = $this->db()->exec(
            'UPDATE ' . $this->table . ' SET ' . $assignments . ' WHERE id = :id',
            $data,
        );
        return is_int($result) ? $result : 0;
    }

    public function delete(int $id): int
    {
        $result = $this->db()->exec(
            'DELETE FROM ' . $this->table . ' WHERE id = :id',
            ['id' => $id],
        );
        return is_int($result) ? $result : 0;
    }
}
