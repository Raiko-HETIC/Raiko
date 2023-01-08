<?php

namespace App\Factory;
use App\Interface\ConnectionInterface;
use Exception;
use PDO;

class PDOFactory implements ConnectionInterface
{
    public PDO $pdo;

    private static string $dsn = 'mysql:host=db';
    private static string $username = 'root';
    private static string $password = 'password';
    private static int $connect_timeout_in_seconds = 5;
    const DATABASE = 'Raito';

    public static function getMysqlConnection(): PDO
    {
        $db = new PDO(self::$dsn, self::$username, self::$password, array(PDO::ATTR_TIMEOUT => self::$connect_timeout_in_seconds));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public function getConnection(): PDO {
        return self::getMysqlConnection();
    }
}