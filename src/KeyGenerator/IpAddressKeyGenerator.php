<?php
/**
 * This file is part of the Rate Limit package.
 *
 * Copyright (c) Nikola Posa
 *
 * For full copyright and license information, please refer to the LICENSE file,
 * located at the package root folder.
 */

declare(strict_types=1);

namespace RateLimit\KeyGenerator;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Nikola Posa <posa.nikola@gmail.com>
 */
final class IpAddressKeyGenerator implements KeyGeneratorInterface
{
    public function getKey(ServerRequestInterface $serverRequest) : string
    {
        $serverParams = $serverRequest->getServerParams();

        if (array_key_exists('HTTP_CLIENT_IP', $serverParams)) {
            return $serverParams['HTTP_CLIENT_IP'];
        }

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $serverParams)) {
            return $serverParams['HTTP_X_FORWARDED_FOR'];
        }

        return $serverParams['REMOTE_ADDR'] ?? 'UNKNOWN';
    }
}
