<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 21:55
 */

namespace NicoBatty\ThePlaylist\Controller;

class VideoControllerFactory implements ControllerFactoryInterface
{
    public function create(): ControllerInterface
    {
        $controller = new VideoController();

        return $controller;
    }
}