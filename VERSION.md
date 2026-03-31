4.1.0

## Added
- Organization team/access management methods:
  - `listTeamAccess`, `retrieveTeamAccess`, `removeTeamAccess`
  - `listSentTeamInvites`, `inviteUserToTeam`, `cancelTeamInvite`
  - `listReceivedTeamInvites`, `respondTeamInvite`
  - `listTeamRoles`, `listTeamRoleTemplates`, `listTeamRoleOperations`
  - `retrieveTeamRole`, `createTeamRole`, `updateTeamRole`, `deleteTeamRole`

## Changed
- `organizations.checkDomainAvailability($query)` is now the canonical method for domain checks.
- `organizations.checkDomainIsAvailable(...)` remains available as a deprecated alias for v4 compatibility.
