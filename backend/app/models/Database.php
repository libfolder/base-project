<?php

declare(strict_types=1);

namespace Models;

use DB\SQL;

class Database
{
    private static ?SQL $sql = null;

    /** Shared F3 SQL connection built from DB_DSN/DB_USER/DB_PASS. */
    public static function connection(): SQL
    {
        if (self::$sql === null) {
            $f3 = \Base::instance();
            self::$sql = new SQL(
                (string) $f3->get('DB_DSN'),
                (string) $f3->get('DB_USER'),
                (string) $f3->get('DB_PASS'),
            );
        }
        return self::$sql;
    }
}
