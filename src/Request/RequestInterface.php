<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 19:14
 */

namespace NicoBatty\ThePlaylist\Request;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getUri();

    /**
     * @param string $uri
     */
    public function setUri(string $uri);

    /**
     * @return array
     */
    public function getQuery();

    /**
     * @param array $query
     */
    public function setQuery(array $query);

    /**
     * @return array
     */
    public function getPost();

    /**
     * @param array $post
     */
    public function setPost(array $post);

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @param string $method
     */
    public function setMethod(string $method);

    /**
     * @return mixed
     */
    public function getHeaders();

    /**
     * @param mixed $headers
     */
    public function setHeaders(array $headers);
}