<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Hostarium\ApiWrapper;

use Exception;

/**
 * This provision category contains the common functions used in provisioning
 * flows for accounts/websites on various popular shared hosting platforms.
 */
class WrapperException extends Exception
{

    /**
     * Return the raw error from the underlying cURL instance
     * 
     * @link https://curl.se/libcurl/c/libcurl-errors.html cURL error code definitions
     * 
     * @return int Raw cURL response or 0 if non found
     **/
    public function getCurlError(): int
    {
        // Technically 0 is an OK response in cURL
        // Since this only shows up during an error though it *should* be fine
        $curlError = Exception::getPrevious()->getTrace()[0]['args'][1]['errno'] ?? 0;

        return $curlError;
    }
}
