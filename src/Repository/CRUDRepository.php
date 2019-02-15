<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:23
 */

namespace NicoBatty\ThePlaylist\Repository;

use NicoBatty\ThePlaylist\Exception\NotFoundException;

class CRUDRepository implements RepositoryInterface
{
    protected $pdo;

    protected $tableName;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundException
     */
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `{$this->tableName}` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);

        $video = $stmt->fetch();
        if (!$video) {
            throw new NotFoundException("This {$this->tableName} is missing");
        }

        return $video;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM `{$this->tableName}`");
        $videos = $stmt->fetchAll();

        return $videos;
    }

    /**
     * @param $data
     * @return mixed
     * @throws NotFoundException
     */
    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `{$this->tableName}` (`title`) VALUES (:title)");
        $stmt->execute($data);
        $lastId = $this->pdo->lastInsertId();

        return $this->findById($lastId);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     * @throws NotFoundException
     */
    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE `{$this->tableName}` SET `title` = :title WHERE id = :id");
        $stmt->execute($data + ['id' => $id]);

        return $this->findById($id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundException
     */
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `{$this->tableName}` WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}