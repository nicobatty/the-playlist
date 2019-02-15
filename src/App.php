<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 19:38
 */

namespace NicoBatty\ThePlaylist;

use mysql_xdevapi\Exception;
use NicoBatty\ThePlaylist\Controller\ControllerFactoryInterface;
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
     * @return
     * @throws \Exception
     */
    public function handle(RequestInterface $request)
    {
        $route = $this->router->resolveRoute($request);
        $factoryName = $route->getFactory();
        $controller = $this->getController($factoryName);
        $methodName = $this->getMethodName($request, $route);
        $params = $route->getParams();
        $params[] = $request;

        $response = $controller->$methodName(...$params);

        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param Route $route
     * @return mixed
     * @throws \Exception
     */
    protected function getMethodName(RequestInterface $request, Route $route)
    {
        $method = $request->getMethod();
        $methodMapping = $route->getMethodMapping();
        if (!isset($methodMapping[$method])) {
            throw new \Exception('No action found for this method');
        }
        return $methodMapping[$method];
    }

    /**
     * @param $factoryName
     * @return Controller\ControllerInterface
     */
    protected function getController($factoryName)
    {
        /** @var ControllerFactoryInterface $factory */
        $factory = new $factoryName;
        $controller = $factory->create();

        return $controller;
    }
}