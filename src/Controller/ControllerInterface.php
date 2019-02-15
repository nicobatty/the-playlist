<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 22:04
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\Request\RequestInterface;

interface ControllerInterface
{
    public function get(int $id);

    public function getList();

    public function post(RequestInterface $request);

    public function put(int $id, RequestInterface $request);

    public function delete(int $id);
}