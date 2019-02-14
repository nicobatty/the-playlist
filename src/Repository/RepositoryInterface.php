<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:23
 */

namespace NicoBatty\ThePlaylist\Repository;


interface RepositoryInterface
{
    public function findById($id);
}