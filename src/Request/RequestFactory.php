<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 19:08
 */

namespace NicoBatty\ThePlaylist\Request;

class RequestFactory
{
    /**
     * Contains all GET, POST, SERVER, HEADERS informations available
     *
     * @param array $params
     * @return RequestInterface
     */
    public function create(array $params)
    {
        $request = new Request();
        $request->setUri($params['uri']);
        $request->setBody($params['body']);
        $request->setHeaders($params['headers']);
        $request->setPost($params['post']);
        $request->setQuery($params['query']);
        $request->setMethod($params['method']);

        return $request;
    }
}