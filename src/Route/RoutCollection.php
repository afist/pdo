<?php
/**
 * Created by PhpStorm.
 * Date: 05.06.2018
 * Time: 7:47
 */

namespace App\Route;

use App\Controller\DistrictController;

class RoutCollection
{
    public static function routCollection($rout, $post){
        if (!is_null($rout)) {
            $routCol = function ($rout, $post){
                $routColl = [
                    'DistrictController::getList' => DistrictController::getList(),
                    'DistrictController::addDistrict' => DistrictController::addDistrict($post),
                    'DistrictController::getDistrict' => DistrictController::getDistrict($rout[1]),
                    'DistrictController::putDistrict' => DistrictController::putDistrict($post),
//                'DistrictController::deleteDistrict' => DistrictController::deleteDistrict($rout[1]),
                ];
                return $routColl[$rout[0]];
            };
            return $routCol($rout, $post);
        }
    }

}