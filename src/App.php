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

        $response = $controller->$methodName(...$params);

        return $response;
    }

    protected function getMethodName(RequestInterface $request, Route $route)
    {
        $method = $request->getMethod();
        $methodMapping = $route->getMethodMapping();
        return $methodMapping[$method];
    }

    protected function getController($factoryName)
    {
        /** @var ControllerFactoryInterface $factory */
        $factory = new $factoryName;
        $controller = $factory->create();

        return $controller;
    }
}