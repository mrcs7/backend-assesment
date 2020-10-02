<?php


namespace App\ParentAp\DataProviders;


use App\ParentAp\Enums\DataProvidersEnum;
use App\ParentAp\ProviderInterface;

class ProviderY implements  ProviderInterface
{
    private $providerPath;

    public function __construct()
    {
        $this->providerPath = storage_path() . "/data/DataProviderY.json";
    }

    public function getData()
    {
        $data = json_decode(file_get_contents($this->providerPath ), true);
        return $this->parseData($data);
    }

    public function parseData($data)
    {
        $parsedData =[];
        foreach($data['users'] as $user){
            $parsedUser['id'] = $user['id'];
            $parsedUser['currency'] = $user['currency'];
            $parsedUser['email'] = $user['email'];
            $parsedUser['status'] = DataProvidersEnum::$status['DataProviderY'][$user['status']];
            $parsedUser['registration_date'] = $user['created_at'];
            $parsedUser['amount'] = $user['balance'];
            $parsedUser['provider'] = $this->getProviderName();
            $parsedData[] =$parsedUser;
        }
        return $parsedData;
    }

    public function getProviderName()
    {
        return DataProvidersEnum::PROVIDER_Y;
    }
}
