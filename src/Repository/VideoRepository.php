<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:23
 */

namespace NicoBatty\ThePlaylist\Repository;

use NicoBatty\ThePlaylist\Exception\NotFoundException;

class VideoRepository implements RepositoryInterface
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundException
     */
    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `video` WHERE `id` = :id');
        $stmt->execute(['id' => $id]);

        $video = $stmt->fetch();
        if (!$video) {
            throw new NotFoundException('This video is missing');
        }

        return $video;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM `video`');
        $videos = $stmt->fetchAll();

        return $videos;
    }
}