<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:19
 */

namespace NicoBatty\ThePlaylist\Controller;

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
            // TODO Convert
            $response->setBody(['foo' => 'bar', 'bar' => 'baz']);
        } catch (\Exception $e) {
            $response->setBody(
                ['error' => $e->getMessage()]
            );
        }
        return $response;
    }

    public function getList()
    {
        // TODO Implement
    }

    public function create()
    {
        // TODO Implement
    }

    public function update(int $id)
    {
        // TODO Implement
    }

    public function delete(int $id)
    {
        // TODO Implement
    }
}