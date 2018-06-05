<?php
/**
 * User: Serhii T.
 * Date: 6/1/18
 */

namespace App\Route;

class RouteHandler
{
    public static  function init()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/districts', 'DistrictController::getList');
            $r->addRoute('GET', '/districts/{id:\d+}', 'DistrictController::getDistrict');
            $r->addRoute('POST', '/districts', 'DistrictController::addDistrict');
            $r->addRoute('POST', '/districts/{id:\d+}', 'DistrictController::putDistrict');
            $r->addRoute('DELETE', '/districts/{id:\d+}', 'DistrictController::deleteDistrict');

            $r->addRoute('GET', '/street', 'StreetController::getList');
            $r->addRoute('GET', '/street/{id:\d+}', 'StreetController::getDistrict');
            $r->addRoute('POST', '/street', 'StreetController::addDistrict');
            $r->addRoute('POST', '/street/{id:\d+}', 'StreetController::putDistrict');
            $r->addRoute('DELETE', '/street/{id:\d+}', 'StreetController::deleteDistrict');

        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REDIRECT_URL'];


// Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {

            case \FastRoute\Dispatcher::NOT_FOUND:
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $handler = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler[] = $routeInfo[1];
                $handler[] = (int)$routeInfo[2]['id'];
                // ... call $handler with $vars
                break;
        }

        return $handler;
    }
}
