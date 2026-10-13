<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum OrganizationPermissionRoleCreateInputTemplateCodeEnum: string
{
    case ORG_ADMIN = 'org-admin';
    case ORG_READONLY = 'org-readonly';
    case ORG_BILLING = 'org-billing';
    case ORG_DEVELOPER = 'org-developer';
    case ORG_TEAM_MANAGER = 'org-team-manager';
}
