<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:42
 */

namespace NicoBatty\ThePlaylist;

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
}