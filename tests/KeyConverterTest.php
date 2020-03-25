<?php

declare(strict_types=1);

namespace Strobotti\JWK\Tests;

use PHPUnit\Framework\TestCase;
use Strobotti\JWK\Key\KeyInterface;
use Strobotti\JWK\Key\Rsa;
use Strobotti\JWK\KeyConverter;

final class KeyConverterTest extends TestCase
{
    /**
     * @param KeyInterface $key
     * @param string       $expected
     *
     * @dataProvider provideKeyToPem
     */
    public function testKeyToPem(KeyInterface $key, string $expected): void
    {
        $converter = new KeyConverter();
        static::assertSame(
            \str_replace("\r", '', $expected),
            \str_replace("\r", '', $converter->keyToPem($key))
        );
    }

    /**
     * @return \Generator
     */
    public function provideKeyToPem(): \Generator
    {
        yield [
            'key' => Rsa::createFromJSON('{
                "kty": "RSA",
                "kid": "eXaunmL",
                "use": "sig",
                "alg": "RS256",
                "n": "4dGQ7bQK8LgILOdLsYzfZjkEAoQeVC_aqyc8GC6RX7dq_KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdDNq1n52TpxQwI2EqxSk7I9fKPKhRt4F8-2yETlYvye-2s6NeWJim0KBtOVrk0gWvEDgd6WOqJl_yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X-Tip84wqwyRpUlq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll-p_Dg8vAXxJLIJ4SNLcqgFeZe4OfHLgdzMvxXZJnPp_VgmkcpUdRotazKZumj6dBPcXI_XID4Z4Z3OM1KrZPJNdUhxw",
                "e": "AQAB"
            }'),
            'expected' => <<<'EOT'
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4dGQ7bQK8LgILOdLsYzf
ZjkEAoQeVC/aqyc8GC6RX7dq/KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdD
Nq1n52TpxQwI2EqxSk7I9fKPKhRt4F8+2yETlYvye+2s6NeWJim0KBtOVrk0gWvE
Dgd6WOqJl/yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X+Tip84wqwyRpU
lq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll+p/Dg8vAXxJLIJ4SNLcqgFeZe
4OfHLgdzMvxXZJnPp/VgmkcpUdRotazKZumj6dBPcXI/XID4Z4Z3OM1KrZPJNdUh
xwIDAQAB
-----END PUBLIC KEY-----
EOT
        ];
    }
}