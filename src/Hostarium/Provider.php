<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Hostarium;

use Upmind\ProvisionProviders\SharedHosting\Hostarium\Data\HostariumCredentials;
use Upmind\ProvisionBase\Provider\Contract\ProviderInterface;
use Upmind\ProvisionProviders\SharedHosting\Category as SharedHosting;
use Upmind\ProvisionBase\Result\ProviderResult;
use Upmind\ProvisionBase\Exception\ProvisionFunctionError;
use Upmind\ProvisionBase\Provider\DataSet\AboutData;

class Provider extends SharedHosting implements ProviderInterface
{
    protected $configuration;

    protected $client;

    public function __construct(HostariumCredentials $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function aboutProvider(): AboutData
    {
        return AboutData::create()
            ->setName('Hostarium')
            ->setDescription('Create and manage users and packages under your Hostarium reseller account');
    }
}
