<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 19:56
 */

namespace NicoBatty\ThePlaylist;

use NicoBatty\ThePlaylist\Connection\DbConnectionFactory;

class CompositionRoot
{
    /**
     * @return \PDO
     */
    public function getDbConnection()
    {
        $config = [
            'dbname' => $_ENV['MYSQL_DATABASE'],
            'host' => $_ENV['MYSQL_HOST'],
            'port' => $_ENV['MYSQL_PORT'],
            'username' => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD'],
        ];

        $connection = (new DbConnectionFactory())->create($config);

        return $connection;
    }
}