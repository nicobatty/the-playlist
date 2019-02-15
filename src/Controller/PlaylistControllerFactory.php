<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 21:55
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\CompositionRoot;
use NicoBatty\ThePlaylist\Repository\PlaylistRepository;

class PlaylistControllerFactory implements ControllerFactoryInterface
{
    const PLAYLIST_TABLE_NAME = 'playlist';

    public function create(): ControllerInterface
    {
        $compositionRoot = new CompositionRoot();
        $connection = $compositionRoot->getDbConnection();

        $repository = new PlaylistRepository($connection);
        $repository->setTableName(self::PLAYLIST_TABLE_NAME);

        $controller = new PlaylistController($repository);

        return $controller;
    }
}