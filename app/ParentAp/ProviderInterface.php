<?php


namespace App\ParentAp;


interface ProviderInterface
{
    public function getData();

    public function parseData($data);

    public function getProviderName();
}
