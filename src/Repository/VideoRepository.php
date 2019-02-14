<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:23
 */

namespace NicoBatty\ThePlaylist\Repository;


class VideoRepository implements RepositoryInterface
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }
}