<?php


namespace App\ParentAp\Services;


use App\ParentAp\ProviderInterface;

class UsersService
{
    private $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function listData($requestData=null)
    {
        $dataCollection = collect($this->provider->getData());
        if(!empty($requestData['status'])){
            $dataCollection = $dataCollection->where('status','=',$requestData['status']);
        }
        if(!empty($requestData['currency'])){
            $dataCollection = $dataCollection->where('currency','=',$requestData['currency']);
        }
        if(!empty($requestData['balanceMin'])){
            $dataCollection = $dataCollection->where('amount','>=',$requestData['balanceMin']);
        }
        if(!empty($requestData['balanceMax'])){
            $dataCollection = $dataCollection->where('amount','<=',$requestData['balanceMax']);
        }
        return $dataCollection->all();

    }
}
