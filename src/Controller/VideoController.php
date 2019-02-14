<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:19
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\Exception\NotFoundException;
use NicoBatty\ThePlaylist\Repository\RepositoryInterface;
use NicoBatty\ThePlaylist\Response\JsonResponse;

class VideoController implements ControllerInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $id)
    {
        $response = new JsonResponse();
        try {
            $video = $this->repository->findById($id);
            $response->setBody($video);
        } catch (NotFoundException $e) {
            $this->updateNotFoundResponse($response, $e);
        }
        return $response;
    }

    public function getList()
    {
        $response = new JsonResponse();
        $videos = $this->repository->findAll();
        $response->setBody($videos);
        return $response;
    }

    protected function updateNotFoundResponse(JsonResponse $response, \Exception $e)
    {
        $response->setBody(
            ['error' => $e->getMessage()]
        );
        $response->setHttpCode(404);
    }

    public function post()
    {
        // TODO Implement
    }

    public function put(int $id)
    {
        // TODO Implement
    }

    public function delete(int $id)
    {
        // TODO Implement
    }
}