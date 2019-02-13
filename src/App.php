<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 19:38
 */

namespace NicoBatty\ThePlaylist;

use mysql_xdevapi\Exception;
use NicoBatty\ThePlaylist\Request\RequestInterface;

class App
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param RequestInterface $request
     * @throws \Exception
     */
    public function handle(RequestInterface $request)
    {
        $controller = $this->router->resolveController($request);
        $id = $this->router->resolveId($request);
        $methodName = $this->getMethodName($request, $id);
        $controller->$methodName($id);
    }

    protected function getMethodName(RequestInterface $request, ?int $id)
    {
        switch ($request->getMethod()) {
            case 'GET':
                if ($id) {
                    return 'get';
                } else {
                    return 'getList';
                }
            case 'POST':
                return 'create';
            case 'PUT':
                return 'update';
            case 'DELETE':
                return 'delete';
            default:
                throw new Exception('Invalid HTTP Method');
        }
    }
}