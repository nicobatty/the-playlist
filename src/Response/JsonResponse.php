<?php
/**
 * Author: Nicolas Batty
 * Date: 14/02/19
 * Time: 00:28
 */

namespace NicoBatty\ThePlaylist\Response;


class JsonResponse
{
    protected $body;

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function render()
    {
        $json = json_encode($this->body);

        header('Content-Type: application/json');
        echo $json;
    }
}