<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Hostarium\Data;

use Upmind\ProvisionBase\Provider\DataSet\DataSet;
use Upmind\ProvisionBase\Provider\DataSet\Rules;

/**
 * Hostarium reseller API credentials.
 *
 * @property-read string $api_url API base URL
 * @property-read string|null $api_token API bearer token
 */
class HostariumCredentials extends DataSet
{
    public static function rules(): Rules
    {
        return new Rules([
            'api_url'   => ['required', 'domain_name'],
            'api_token' => ['required', 'alpha_num'],
        ]);
    }
}
