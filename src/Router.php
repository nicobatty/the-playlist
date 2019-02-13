<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 20:42
 */

namespace NicoBatty\ThePlaylist;

use NicoBatty\ThePlaylist\Controller\ControllerFactoryInterface;
use NicoBatty\ThePlaylist\Controller\ControllerInterface;
use NicoBatty\ThePlaylist\Request\RequestInterface;

class Router
{
    protected $routing;

    public function __construct(array $routing)
    {
        $this->routing = $routing;
    }

    /**
     * @param RequestInterface $request
     * @return ControllerInterface
     * @throws \Exception
     */
    public function resolveController(RequestInterface $request): ControllerInterface
    {
        $uri = $request->getUri();
        $controllerFactory = $this->getControllerFactory($uri);
        return $controllerFactory->create();
    }

    /**
     * @param RequestInterface $request
     * @return int|null
     */
    public function resolveId(RequestInterface $request): ?int
    {
        $uri = $request->getUri();

        preg_match('/\\/[a-z]+\\/([\\d]+)/', $uri, $matches);

        return $matches[1] ?? null;
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