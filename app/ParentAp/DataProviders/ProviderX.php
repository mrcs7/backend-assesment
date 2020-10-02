<?php


namespace App\ParentAp\DataProviders;


use App\ParentAp\Enums\DataProvidersEnum;
use App\ParentAp\ProviderInterface;

class ProviderX implements ProviderInterface
{
    private $providerPath;

    public function __construct()
    {
        $this->providerPath = storage_path() . "/data/DataProviderX.json";
    }

    public function getData()
    {
        $data = json_decode(file_get_contents($this->providerPath), true);
        return $this->parseData($data);
    }

    public function parseData($data)
    {
        $parsedData =[];
        foreach($data['users'] as $user){
            $parsedUser['id'] = $user['parentIdentification'];
            $parsedUser['currency'] = $user['Currency'];
            $parsedUser['email'] = $user['parentEmail'];
            $parsedUser['status'] = DataProvidersEnum::$status['DataProviderX'][$user['statusCode']];
            $parsedUser['registration_date'] = $user['registerationDate'];
            $parsedUser['amount'] = $user['parentAmount'];
            $parsedUser['provider'] = $this->getProviderName();
            $parsedData[] =$parsedUser;
        }
        return $parsedData;
    }

    public function getProviderName()
    {
        return DataProvidersEnum::PROVIDER_X;
    }

}
