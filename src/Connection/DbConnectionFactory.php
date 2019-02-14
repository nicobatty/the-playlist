<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 19:44
 */

namespace NicoBatty\ThePlaylist\Connection;


class DbConnectionFactory
{
    const DEFAULT_PORT = 3306;
    const PDO_OPTIONS = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public function create(array $config)
    {
        [$dsn, $username, $password] = $this->toPdoConfig($config);
        $pdo = new \PDO($dsn, $username, $password, self::PDO_OPTIONS);
        return $pdo;
    }

    protected function toPdoConfig(array $config)
    {
        $host = $config['host'];
        $dbname = $config['dbname'];
        $port = $config['port'] ?? self::DEFAULT_PORT;
        $username = $config['username'];
        $password = $config['password'];
        $dsn = $this->getDsn($host, $dbname, $port);
        return [$dsn, $username, $password];
    }

    protected function getDsn($host, $dbname, $port)
    {
        return "mysql:host=$host;dbname=$dbname;port=$port";
    }
}
