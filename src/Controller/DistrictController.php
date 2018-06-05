<?php
namespace App\Controller;

use App\Model\District;
use App\Store\StoreModels\StoreHandlerInterface;

class DistrictController
{
//    private static const $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
    public static function getList()
    {
        $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
        $text="<table class='new-table'><tr><th>id</th><th>Name</th><th>Population</th><th>Description</th><th>Редакт</th><th>Удалить</th></tr >";
        /** @var District $value */
        foreach ($storeHandlerDistrict->collection() as $value){
            $text.="<tr><td class=\"id\">{$value->getId()}</td><td >{$value->getName()}</td>
                    <td>{$value->getPopulation()}</td><td>{$value->getDescription()}</td><td><button class='edit'>редакт</button></td><td><button class='delete'>удалить</button></td></tr>";
        }

        $text .= "</table>";

        return $text;
    }
    public static function addDistrict($post)
    {
        if (is_null($post['idedit'])){
            $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
            $newDistrict = new \App\Model\District;
            $newDistrict->setName($post['name']);
            $newDistrict->setPopulation($post['population']);
            $newDistrict->setDescription($post['description']);
            $storeHandlerDistrict->create($newDistrict);
        }

    }
    public static function deleteDistrict($id)
    {
        if (!is_null($id)){
            $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
            $storeHandlerDistrict->deleteById($id);
        }

    }
    public static function getDistrict($id)
    {
        if (!is_null($id)){
        $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
        $editDistrict = $storeHandlerDistrict->findById($id);
        return $editDistrict->getName().";".$editDistrict->getPopulation().";".$editDistrict->getDescription();
        }
    }
    public static function putDistrict( $post)
    {
        if (!is_null($post)){
        $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);
        $editDistrict = $storeHandlerDistrict->findById((int)$post['idedit']);
        $editDistrict->setName($post['name']);
        $editDistrict->setPopulation($post['population']);
        $editDistrict->setDescription($post['description']);
        $storeHandlerDistrict->update($editDistrict);

        }
    }
}
