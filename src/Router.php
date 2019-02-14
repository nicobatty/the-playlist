<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:42
 */

namespace NicoBatty\ThePlaylist;

use NicoBatty\ThePlaylist\Controller\ControllerFactoryInterface;
use NicoBatty\ThePlaylist\Request\RequestInterface;

class Router
{
    /**
     * @var Route[]
     */
    protected $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param RequestInterface $request
     * @return Route
     * @throws \Exception
     */
    public function resolveRoute(RequestInterface $request): Route
    {
        $uri = $request->getUri();
        foreach ($this->routes as $route) {
            if ($this->matchRoute($uri, $route)) {
                return $route;
            }
        }
        throw new \Exception('No route match your request');
    }

    protected function matchRoute($uri, Route $route)
    {
        $count = preg_match($route->getUriRegex(), $uri, $matches);
        if (!$count) {
            return false;
        }
        array_shift($matches);
        $route->setParams($matches);
        return true;
    }

    /**
     * @param string $uri
     * @return ControllerFactoryInterface
     * @throws \Exception
     */
    protected function getControllerFactory(string $uri): ControllerFactoryInterface
    {
        $controllerUri = $this->getControllerUri($uri);
        $factoryClass = $this->getMatchRouting($controllerUri);
        $controllerFactory = new $factoryClass;

        return $controllerFactory;
    }

    /**
     * @param string $uri
     * @return string
     * @throws \Exception
     */
    protected function getMatchRouting(string $uri): string
    {
        if (!isset($this->routing[$uri])) {
            throw new \Exception(sprintf('No route available for "%s"', $uri));
        }

        return $this->routing[$uri];
    }

    protected function getControllerUri(string $uri): string
    {
        $slashPos = strpos($uri, '/', 1);
        if ($slashPos !== false) {
            $controllerUri = substr($uri, 0, $slashPos);
        } else {
            $controllerUri = $uri;
        }
        return $controllerUri;
    }
}