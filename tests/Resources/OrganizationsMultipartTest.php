<?php

declare(strict_types=1);
use Facturapi\Exceptions\FacturapiException;

describe('OrganizationsMultipart', function () {
    test('upload logo builds multipart request', function () {
        $tmpLogo = tempnam(sys_get_temp_dir(), 'logo_');
        file_put_contents($tmpLogo, 'LOGO_BYTES');

        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->uploadLogo('org_123', $tmpLogo);

        expect($result->id)->toBe('org_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/logo');
        expect($request->getHeaderLine('Content-Type'))->toStartWith('multipart/form-data; boundary=');

        $body = (string) $request->getBody();
        expect($body)->toContain('name="file"');
        expect($body)->toContain('filename="' . basename($tmpLogo) . '"');
        expect($body)->toContain('LOGO_BYTES');

        @unlink($tmpLogo);
    });
    test('upload certificate builds multipart request with cer key and password', function () {
        $tmpCer = tempnam(sys_get_temp_dir(), 'cer_');
        $tmpKey = tempnam(sys_get_temp_dir(), 'key_');
        file_put_contents($tmpCer, 'CER_BYTES');
        file_put_contents($tmpKey, 'KEY_BYTES');

        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->uploadCertificate('org_123', [
            'cerFile' => $tmpCer,
            'keyFile' => $tmpKey,
            'password' => 'secret_password',
        ]);

        expect($result->id)->toBe('org_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/certificate');

        $body = (string) $request->getBody();
        expect($body)->toContain('name="cer"');
        expect($body)->toContain('name="key"');
        expect($body)->toContain('name="password"');
        expect($body)->toContain('CER_BYTES');
        expect($body)->toContain('KEY_BYTES');
        expect($body)->toContain('secret_password');

        @unlink($tmpCer);
        @unlink($tmpKey);
    });
    test('upload certificate fails when required fields are missing', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        expect(fn () => $organizations->uploadCertificate('org_123', [
            'cerFile' => '/tmp/cert.cer',
        ]))->toThrow(FacturapiException::class, 'Invalid certificate payload. Expected cerFile, keyFile and password.');
    });
    test('upload logo fails when file cannot be opened', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        expect(fn () => $organizations->uploadLogo('org_123', '/tmp/file_that_does_not_exist.pdf'))
            ->toThrow(FacturapiException::class, 'Unable to open file: /tmp/file_that_does_not_exist.pdf');
    });
    test('upload logo throws on non2xx and preserves error shape', function () {
        $tmpLogo = tempnam(sys_get_temp_dir(), 'logo_');
        file_put_contents($tmpLogo, 'LOGO_BYTES');

        $errorBody = [
            'message' => 'Upload failed',
            'code' => 'upload_error',
            'details' => [
                ['path' => 'file', 'message' => 'Invalid file'],
            ],
        ];

        mockResponse(json_encode($errorBody), 422, ['Content-Type' => 'application/json']);
        $organizations = test()->facturapi->organizations();

        expect(fn () => $organizations->uploadLogo('org_123', $tmpLogo))
            ->toThrow(function (FacturapiException $exception) use ($errorBody) {
                expect($exception->getStatusCode())->toBe(422);
                expect($exception->getMessage())->toBe('Upload failed');
                expect($exception->getErrorData())->toBe($errorBody);
            });

        @unlink($tmpLogo);
    });

});
