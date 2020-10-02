<?php


namespace App\ParentAp\DataProviders;


use App\ParentAp\Enums\DataProvidersEnum;
use App\ParentAp\ProviderInterface;

class AllProviders implements ProviderInterface
{
    public function getData()
    {
        $data=[];
        foreach (DataProvidersEnum::$classes as $dataProvider){
            $provider = new $dataProvider();
            $data = array_merge($data,$provider->getData());
        }
        return $data;
    }

    public function parseData($data)
    {

    }

    public function getProviderName()
    {

    }

}
