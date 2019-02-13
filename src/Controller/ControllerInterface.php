<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 22:04
 */

namespace NicoBatty\ThePlaylist\Controller;

interface ControllerInterface
{
    public function get(int $id);

    public function getList();

    public function create();

    public function update(int $id);

    public function delete(int $id);
}