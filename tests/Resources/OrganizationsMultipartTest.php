<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Resources\Organizations;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OrganizationsMultipartTest extends TestCase
{
    public function testUploadLogoBuildsMultipartRequest(): void
    {
        $tmpLogo = tempnam(sys_get_temp_dir(), 'logo_');
        file_put_contents($tmpLogo, 'LOGO_BYTES');

        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->uploadLogo('org_123', $tmpLogo);

        self::assertTrue($result->ok);

        $request = $httpClient->requests()[0];
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/logo', (string) $request->getUri());
        self::assertStringStartsWith('multipart/form-data; boundary=', $request->getHeaderLine('Content-Type'));

        $body = (string) $request->getBody();
        self::assertStringContainsString('name="file"', $body);
        self::assertStringContainsString('filename="' . basename($tmpLogo) . '"', $body);
        self::assertStringContainsString('LOGO_BYTES', $body);

        @unlink($tmpLogo);
    }

    public function testUploadCertificateBuildsMultipartRequestWithCerKeyAndPassword(): void
    {
        $tmpCer = tempnam(sys_get_temp_dir(), 'cer_');
        $tmpKey = tempnam(sys_get_temp_dir(), 'key_');
        file_put_contents($tmpCer, 'CER_BYTES');
        file_put_contents($tmpKey, 'KEY_BYTES');

        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->uploadCertificate('org_123', [
            'cerFile' => $tmpCer,
            'keyFile' => $tmpKey,
            'password' => 'secret_password',
        ]);

        self::assertTrue($result->ok);

        $request = $httpClient->requests()[0];
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/certificate', (string) $request->getUri());

        $body = (string) $request->getBody();
        self::assertStringContainsString('name="cer"', $body);
        self::assertStringContainsString('name="key"', $body);
        self::assertStringContainsString('name="password"', $body);
        self::assertStringContainsString('CER_BYTES', $body);
        self::assertStringContainsString('KEY_BYTES', $body);
        self::assertStringContainsString('secret_password', $body);

        @unlink($tmpCer);
        @unlink($tmpKey);
    }

    public function testUploadCertificateFailsWhenRequiredFieldsAreMissing(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $this->expectException(FacturapiException::class);
        $this->expectExceptionMessage('Invalid certificate payload. Expected cerFile, keyFile and password.');

        $organizations->uploadCertificate('org_123', [
            'cerFile' => '/tmp/cert.cer',
        ]);
    }

    public function testUploadLogoFailsWhenFileCannotBeOpened(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $this->expectException(FacturapiException::class);
        $this->expectExceptionMessage('Unable to open file: /tmp/file_that_does_not_exist.pdf');

        $organizations->uploadLogo('org_123', '/tmp/file_that_does_not_exist.pdf');
    }
}
