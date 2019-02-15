<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:19
 */

namespace NicoBatty\ThePlaylist\Controller;

use NicoBatty\ThePlaylist\Exception\NotFoundException;
use NicoBatty\ThePlaylist\Repository\RepositoryInterface;
use NicoBatty\ThePlaylist\Request\RequestInterface;
use NicoBatty\ThePlaylist\Response\JsonResponse;

class CRUDController implements ControllerInterface
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
            $object = $this->repository->findById($id);
            $response->setBody($object);
        } catch (NotFoundException $e) {
            $this->updateNotFoundResponse($response, $e);
        }
        return $response;
    }

    public function getList()
    {
        $response = new JsonResponse();
        $objects = $this->repository->findAll();
        $response->setBody($objects);
        return $response;
    }

    public function post(RequestInterface $request)
    {
        $response = new JsonResponse();
        $body = $request->getBody();
        $content = json_decode($body, true);
        $object = $this->repository->create($content);

        $response->setBody($object);

        return $response;
    }

    public function put(int $id, RequestInterface $request)
    {
        $response = new JsonResponse();
        $body = $request->getBody();
        $content = json_decode($body, true);
        try {
            $object = $this->repository->update($id, $content);
            $response->setBody($object);
        } catch (NotFoundException $e) {
            $this->updateNotFoundResponse($response, $e);
        }

        return $response;
    }

    public function delete(int $id)
    {
        $response = new JsonResponse();
        $this->repository->delete($id);

        return $response;
    }

    protected function updateNotFoundResponse(JsonResponse $response, \Exception $e)
    {
        $response->setBody(
            ['error' => $e->getMessage()]
        );
        $response->setHttpCode(404);
    }
}