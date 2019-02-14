<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 22:40
 */

namespace NicoBatty\ThePlaylist;

class Route
{
    protected $uriRegex;

    protected $factory;

    protected $methodMapping;

    protected $params;

    /**
     * @return mixed
     */
    public function getUriRegex()
    {
        return $this->uriRegex;
    }

    /**
     * @param mixed $uriRegex
     * @return Route
     */
    public function setUriRegex($uriRegex): self
    {
        $this->uriRegex = $uriRegex;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param mixed $factory
     * @return Route
     */
    public function setFactory($factory): self
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodMapping()
    {
        return $this->methodMapping;
    }

    /**
     * @param mixed $methodMapping
     * @return Route
     */
    public function setMethodMapping($methodMapping): self
    {
        $this->methodMapping = $methodMapping;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     * @return Route
     */
    public function setParams($params): self
    {
        $this->params = $params;

        return $this;
    }




}