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

    protected $httpCode = 200;

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function render()
    {
        $json = json_encode($this->body);

        http_response_code($this->httpCode);
        header('Content-Type: application/json');
        if ($this->body) {
            echo $json;
        }
    }
}