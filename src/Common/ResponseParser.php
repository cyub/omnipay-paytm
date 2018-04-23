<?php

namespace Omnipay\Paytm\Common;

use Omnipay\Common\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

class ResponseParser
{
    private static function toString($response)
    {
        if ($response instanceof ResponseInterface) {
            return $response->getBody()->__toString();
        }

        return (string) $response;
    }

    public static function json($response)
    {
        $body = static::toString($response);

        $data = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new RuntimeException('Unable to parse response body into JSON: ' . json_last_error());
        }

        return $data === null ? [] : $data;
    }

    public static function xml($response)
    {
        $body = static::toString($response);

        $errorMessage = null;
        $internalErrors = libxml_use_internal_errors(true);
        $disableEntities = libxml_disable_entity_loader(true);
        libxml_clear_errors();

        try {
            $xml = new \SimpleXMLElement((string) $body ?: '<root />', LIBXML_NONET);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);
        libxml_disable_entity_loader($disableEntities);

        if ($errorMessage) {
            throw new RuntimeException('Unable to parse response body into XML: ' . $errorMessage);
        }
        return $xml;
    }
}