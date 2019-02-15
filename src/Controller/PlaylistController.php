<?php
/**
 * Author: Nicolas Batty
 * Date: 15/02/19
 * Time: 01:33
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\Repository\PlaylistRepository;
use NicoBatty\ThePlaylist\Response\JsonResponse;

class PlaylistController extends CRUDController
{
    protected $repository;

    public function __construct(PlaylistRepository $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function addVideo(int $playlistId, int $videoId)
    {
        $response = new JsonResponse();
        $this->repository->addVideo($playlistId, $videoId);

        return $response;
    }

    public function removeVideo(int $playlistId, int $videoId)
    {
        $response = new JsonResponse();
        $this->repository->removeVideo($playlistId, $videoId);

        return $response;
    }

    public function getVideos($playlistId)
    {
        $response = new JsonResponse();
        $videos = $this->repository->findVideos($playlistId);
        $response->setBody($videos);
        return $response;
    }
}