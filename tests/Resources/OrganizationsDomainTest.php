<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Organizations;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OrganizationsDomainTest extends TestCase
{
    public function testCheckDomainIsAvailableUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"available":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->checkDomainIsAvailable([
            'name' => 'acme',
            'domain' => 'acme.mx',
        ]);

        self::assertTrue($result->available);

        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame(
            'https://www.facturapi.io/v2/organizations/domain-check?name=acme&domain=acme.mx',
            (string) $request->getUri()
        );
    }

    public function testCheckDomainIsAvailableAcceptsLegacyTwoArgumentSignature(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"available":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $captured = [];
        set_error_handler(static function (int $severity, string $message) use (&$captured): bool {
            $captured[] = ['severity' => $severity, 'message' => $message];
            return true;
        });

        try {
            $result = $organizations->checkDomainIsAvailable('org_ignored', [
                'name' => 'acme',
                'domain' => 'acme.mx',
            ]);
        } finally {
            restore_error_handler();
        }

        self::assertTrue($result->available);
        self::assertNotEmpty($captured);
        self::assertSame(E_USER_DEPRECATED, $captured[0]['severity']);
        self::assertStringContainsString('checkDomainIsAvailable($params)', $captured[0]['message']);
    }

    public function testCheckDomainAvailabilityAliasDelegatesToCanonicalMethod(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"available":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->checkDomainAvailability([
            'name' => 'acme',
            'domain' => 'acme.mx',
        ]);

        self::assertTrue($result->available);
    }
}
