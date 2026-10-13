<?php

namespace Core;

use PDO;

require_once __DIR__ . '/../app/database.php';

final class Database
{
    /** Trả về kết nối PDO singleton đang được app sử dụng. */
    public static function connection(): PDO
    {
        return \db();
    }

    /** Alias ngắn để code mới có thể gọi Database::getConnection(). */
    public static function getConnection(): PDO
    {
        return self::connection();
    }
}
