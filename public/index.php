<?php

use NicoBatty\ThePlaylist\App;
use NicoBatty\ThePlaylist\Request\RequestFactory;
use NicoBatty\ThePlaylist\Router;

require __DIR__ . '/../autoload.php';

$requestParams = [
    'uri' => $_SERVER['REQUEST_URI'],
    'query' => $_GET,
    'post' => $_POST,
    'method' => $_SERVER['REQUEST_METHOD'],
    'headers' => getallheaders(),
];

$routing = [
    '/videos' => \NicoBatty\ThePlaylist\Controller\VideoControllerFactory::class
];

$request = (new RequestFactory())->create($requestParams);

$router = new Router($routing);

$app = new App($router);
$response = $app->handle($request);

$response->render();

