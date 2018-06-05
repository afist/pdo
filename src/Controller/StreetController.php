<?php
/**
 * Created by PhpStorm.
 * Date: 05.06.2018
 * Time: 17:52
 */

namespace App\Controller;

use App\Model\Street;

class StreetController
{
    public static function getList()
    {
        $storeHandlerStreet = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\Street::class);
        $text="<table class='new-table'><tr><th>id</th><th>Name</th><th>Type</th><th>Id District</th><th>Редакт</th><th>Удалить</th></tr >";
        /** @var Street $value */
        foreach ($storeHandlerStreet->collection() as $value){
            $text.="<tr><td class=\"id\">{$value->getId()}</td><td >{$value->getName()}</td>
                    <td>{$value->getType()}</td><td>{$value->getDistrict()}</td><td><button class='edit'>редакт</button></td><td><button class='delete'>удалить</button></td></tr>";
        }

        $text .= "</table>";

        return $text;
    }
}