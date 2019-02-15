<?php

use NicoBatty\ThePlaylist\App;
use NicoBatty\ThePlaylist\Controller\VideoControllerFactory;
use NicoBatty\ThePlaylist\Request\RequestFactory;
use NicoBatty\ThePlaylist\Route;
use NicoBatty\ThePlaylist\Router;

require __DIR__ . '/../autoload.php';

$requestParams = [
    'uri' => $_SERVER['REQUEST_URI'],
    'body' => file_get_contents('php://input'),
    'query' => $_GET,
    'post' => $_POST,
    'method' => $_SERVER['REQUEST_METHOD'],
    'headers' => getallheaders(),
];

// /videos/<id>
$routing[] = (new Route())->setUriRegex('/\\/videos\\/([\\d]+)$/')
    ->setFactory(VideoControllerFactory::class)
    ->setMethodMapping([
        'GET' => 'get',
        'PUT' => 'put',
        'DELETE' => 'delete'
    ]);

$routing[] = (new Route())->setUriRegex('/\\/videos$/')
    ->setFactory(VideoControllerFactory::class)
    ->setMethodMapping([
        'GET' => 'getList',
        'POST' => 'post'
    ]);

$request = (new RequestFactory())->create($requestParams);

$router = new Router($routing);

$app = new App($router);
$response = $app->handle($request);

$response->render();

