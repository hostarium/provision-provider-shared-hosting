<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Data;

use Upmind\ProvisionBase\Provider\DataSet\DataSet;
use Upmind\ProvisionBase\Provider\DataSet\Rules;

/**
 * Data for uniquely identifying a hosting account.
 *
 * @property-read string|integer|null $customer_id ID of the customer on the hosting platform
 * @property-read string|integer|null $subscription_id ID of the subscription on the hosting platform, if any
 * @property-read string $username Username of the account
 * @property-read string|null $domain Domain name for this account/subscription
 */
class AccountUsername extends DataSet
{
    public static function rules(): Rules
    {
        return new Rules([
            'customer_id' => ['nullable'],
            'subscription_id' => ['nullable'],
            'username' => ['required', 'string'],
            'domain' => ['nullable', 'domain_name'],
        ]);
    }
}
