<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 21:55
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\CompositionRoot;
use NicoBatty\ThePlaylist\Repository\VideoRepository;

class VideoControllerFactory implements ControllerFactoryInterface
{
    public function create(): ControllerInterface
    {
        $compositionRoot = new CompositionRoot();
        $connection = $compositionRoot->getDbConnection();

        $repository = new VideoRepository($connection);

        $controller = new VideoController($repository);

        return $controller;
    }
}