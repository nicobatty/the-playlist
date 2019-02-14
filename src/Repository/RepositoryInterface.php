<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:23
 */

namespace NicoBatty\ThePlaylist\Repository;


use NicoBatty\ThePlaylist\Exception\NotFoundException;

interface RepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     * @throws NotFoundException
     */
    public function findById($id);

    public function findAll();
}