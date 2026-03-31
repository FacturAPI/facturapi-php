<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Organizations;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OrganizationsTeamManagementTest extends TestCase
{
    public function testListTeamAccessUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listTeamAccess('org_123');

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team', (string) $request->getUri());
    }

    public function testRetrieveTeamAccessUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"acc_123"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->retrieveTeamAccess('org_123', 'acc_123');

        self::assertSame('acc_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/acc_123', (string) $request->getUri());
    }

    public function testInviteUserToTeamUsesExpectedEndpointAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"inv_123"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->inviteUserToTeam('org_123', [
            'email' => 'alex@example.com',
            'role' => 'role_123',
        ]);

        self::assertSame('inv_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/invites', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertStringContainsString('"email":"alex@example.com"', (string) $request->getBody());
        self::assertStringContainsString('"role":"role_123"', (string) $request->getBody());
    }

    public function testListSentTeamInvitesUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listSentTeamInvites('org_123');

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/invites', (string) $request->getUri());
    }

    public function testCancelTeamInviteUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->cancelTeamInvite('org_123', 'inv_123');

        self::assertTrue($result->ok);
        $request = $httpClient->requests()[0];
        self::assertSame('DELETE', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/invites/inv_123', (string) $request->getUri());
    }

    public function testListReceivedTeamInvitesUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_user_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listReceivedTeamInvites();

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/invites/pending', (string) $request->getUri());
    }

    public function testRespondTeamInviteUsesExpectedEndpointAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_user_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->respondTeamInvite('inv_123', ['accept' => true]);

        self::assertTrue($result->ok);
        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/invites/inv_123/response', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertStringContainsString('"accept":true', (string) $request->getBody());
    }

    public function testListTeamRolesUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listTeamRoles('org_123');

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles', (string) $request->getUri());
    }

    public function testListTeamRoleTemplatesUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listTeamRoleTemplates('org_123');

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles/templates', (string) $request->getUri());
    }

    public function testListTeamRoleOperationsUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '[]'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->listTeamRoleOperations('org_123');

        self::assertIsArray($result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles/operations', (string) $request->getUri());
    }

    public function testRetrieveTeamRoleUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"role_123"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->retrieveTeamRole('org_123', 'role_123');

        self::assertSame('role_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123', (string) $request->getUri());
    }

    public function testCreateTeamRoleUsesExpectedEndpointAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"role_123","name":"Billing analyst"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->createTeamRole('org_123', [
            'name' => 'Billing analyst',
            'operations' => ['read:invoices'],
        ]);

        self::assertSame('role_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertStringContainsString('"name":"Billing analyst"', (string) $request->getBody());
        self::assertStringContainsString('"operations":["read:invoices"]', (string) $request->getBody());
    }

    public function testUpdateTeamAccessRoleUsesExpectedEndpointAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"acc_123","role":"role_123"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->updateTeamAccessRole('org_123', 'acc_123', 'role_123');

        self::assertSame('acc_123', $result->id);
        self::assertSame('role_123', $result->role);
        $request = $httpClient->requests()[0];
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/acc_123/role', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertStringContainsString('"role":"role_123"', (string) $request->getBody());
    }

    public function testRemoveTeamAccessUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->removeTeamAccess('org_123', 'acc_123');

        self::assertTrue($result->ok);
        $request = $httpClient->requests()[0];
        self::assertSame('DELETE', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/acc_123', (string) $request->getUri());
    }

    public function testUpdateTeamRoleUsesExpectedEndpointAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"role_123","name":"Senior billing analyst"}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->updateTeamRole('org_123', 'role_123', [
            'name' => 'Senior billing analyst',
        ]);

        self::assertSame('role_123', $result->id);
        self::assertSame('Senior billing analyst', $result->name);
        $request = $httpClient->requests()[0];
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertStringContainsString('"name":"Senior billing analyst"', (string) $request->getBody());
    }

    public function testDeleteTeamRoleUsesExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"ok":true}'));
        $organizations = new Organizations('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $organizations->deleteTeamRole('org_123', 'role_123');

        self::assertTrue($result->ok);
        $request = $httpClient->requests()[0];
        self::assertSame('DELETE', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/organizations/org_123/team/roles/role_123', (string) $request->getUri());
    }
}
