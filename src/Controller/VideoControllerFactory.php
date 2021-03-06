<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 21:55
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\CompositionRoot;
use NicoBatty\ThePlaylist\Repository\CRUDRepository;

class VideoControllerFactory implements ControllerFactoryInterface
{
    const VIDEO_TABLE_NAME = 'video';

    public function create(): ControllerInterface
    {
        $compositionRoot = new CompositionRoot();
        $connection = $compositionRoot->getDbConnection();

        $repository = new CRUDRepository($connection);
        $repository->setTableName(self::VIDEO_TABLE_NAME);

        $controller = new CRUDController($repository);

        return $controller;
    }
}