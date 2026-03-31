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

    public function testCheckDomainIsAvailableThrowsWhenParamsAreNotArray(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"available":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $this->expectException(\Facturapi\Exceptions\FacturapiException::class);
        $this->expectExceptionMessage('checkDomainIsAvailable expects $query to be an array.');

        $organizations->checkDomainIsAvailable('invalid');
    }
}
