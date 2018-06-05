<?php

use App\Controller\DistrictController;

use App\Route\RouteHandler;
use App\Route\RoutCollection;

require_once 'vendor/autoload.php';

$host = '127.0.0.1:3305';
$dbName = 'test_db';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    \App\Store\FactoryStore::init($dbh);
    $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
    $storeHandlerStreet = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\Street::class);

    $controllerName = RouteHandler::init();
        $routCollection  = [
            'DistrictController::getList' => DistrictController::getList(),
            'DistrictController::addDistrict' => DistrictController::addDistrict($_POST),
            'DistrictController::getDistrict' => DistrictController::getDistrict($controllerName[1]),
            'DistrictController::putDistrict' => DistrictController::putDistrict($_POST),
//            'DistrictController::deleteDistrict' => DistrictController::deleteDistrict($controllerName[1]),
//            'StreetController::getList' => StreetController::getList(),
//            'StreetController::addStreet' => DistrictController::addDistrict($_POST),
//            'StreetController::getStreet' => DistrictController::getDistrict($controllerName[1]),
//            'StreetController::putStreet' => DistrictController::putDistrict($_POST),
//            'StreetController::deleteStreet' => DistrictController::deleteDistrict($controllerName[1]),

        ];


    echo $routCollection[$controllerName[0]];
//    echo RoutCollection::routCollection($controllerName, $_POST)();





} catch (PDOException $exception) {
    echo $exception->getMessage();
} catch (Exception $e) {
}


