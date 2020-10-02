<?php


namespace App\ParentAp\Enums;


use App\ParentAp\DataProviders\AllProviders;
use App\ParentAp\DataProviders\ProviderX;
use App\ParentAp\DataProviders\ProviderY;

class DataProvidersEnum extends Enum
{
    const PROVIDER_X = 'DataProviderX';
    const PROVIDER_Y = 'DataProviderY';

    /**
     * @var array
     */
    public static $classes = [
        self::PROVIDER_X => ProviderX::class,
        self::PROVIDER_Y => ProviderY::class,
    ];

    /**
     * @var array
     */
    public static $status = [
        self::PROVIDER_X => [
            1=>'authorised',
            2=>'declined',
            3=>'refunded'
        ],
        self::PROVIDER_Y => [
            100=>'authorised',
            200=>'declined',
            300=>'refunded'
        ],
    ];
}
