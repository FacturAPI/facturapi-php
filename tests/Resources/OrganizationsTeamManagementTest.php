<?php

declare(strict_types=1);
describe('OrganizationsTeamManagement', function () {
    test('list team access uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listTeamAccess('org_123');

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team');
    });
    test('retrieve team access uses expected endpoint', function () {
        mockResponse('{"id":"acc_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->retrieveTeamAccess('org_123', 'acc_123');

        expect($result['id'])->toBe('acc_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/acc_123');
    });
    test('invite user to team uses expected endpoint and json body', function () {
        mockResponse('{"id":"inv_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->inviteUserToTeam('org_123', [
            'email' => 'alex@example.com',
            'role' => 'role_123',
        ]);

        expect($result['id'])->toBe('inv_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/invites');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toContain('"email":"alex@example.com"');
        expect((string) $request->getBody())->toContain('"role":"role_123"');
    });
    test('list sent team invites uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listSentTeamInvites('org_123');

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/invites');
    });
    test('cancel team invite uses expected endpoint', function () {
        mockResponse('{"ok":true}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->cancelTeamInvite('org_123', 'inv_123');

        expect($result['ok'])->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/invites/inv_123');
    });
    test('list received team invites uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listReceivedTeamInvites();

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/invites/pending');
    });
    test('respond team invite uses expected endpoint and json body', function () {
        mockResponse('{"ok":true}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->respondTeamInvite('inv_123', ['accept' => true]);

        expect($result['ok'])->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/invites/inv_123/response');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toContain('"accept":true');
    });
    test('list team roles uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listTeamRoles('org_123');

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles');
    });
    test('list team role templates uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listTeamRoleTemplates('org_123');

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles/templates');
    });
    test('list team role operations uses expected endpoint', function () {
        mockResponse('[]', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->listTeamRoleOperations('org_123');

        expect($result)->toBeArray();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles/operations');
    });
    test('retrieve team role uses expected endpoint', function () {
        mockResponse('{"id":"role_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->retrieveTeamRole('org_123', 'role_123');

        expect($result['id'])->toBe('role_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123');
    });
    test('create team role uses expected endpoint and json body', function () {
        mockResponse('{"id":"role_123","name":"Billing analyst"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->createTeamRole('org_123', [
            'name' => 'Billing analyst',
            'operations' => ['read:invoices'],
        ]);

        expect($result['id'])->toBe('role_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toContain('"name":"Billing analyst"');
        expect((string) $request->getBody())->toContain('"operations":["read:invoices"]');
    });
    test('update team access role uses expected endpoint and json body', function () {
        mockResponse('{"id":"acc_123","role":"role_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->updateTeamAccessRole('org_123', 'acc_123', 'role_123');

        expect($result['id'])->toBe('acc_123');
        expect($result['role'])->toBe('role_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/acc_123/role');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toContain('"role":"role_123"');
    });
    test('remove team access uses expected endpoint', function () {
        mockResponse('{"ok":true}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->removeTeamAccess('org_123', 'acc_123');

        expect($result['ok'])->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/acc_123');
    });
    test('update team role uses expected endpoint and json body', function () {
        mockResponse('{"id":"role_123","name":"Senior billing analyst"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->updateTeamRole('org_123', 'role_123', [
            'name' => 'Senior billing analyst',
        ]);

        expect($result['id'])->toBe('role_123');
        expect($result['name'])->toBe('Senior billing analyst');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toContain('"name":"Senior billing analyst"');
    });
    test('delete team role uses expected endpoint', function () {
        mockResponse('{"ok":true}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->deleteTeamRole('org_123', 'role_123');

        expect($result['ok'])->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123');
    });

});
