4.0.0

## 🚨 Breaking Changes
- Impact: update required only if you use PHP < 8.2 or relied on the positional `apiVersion` constructor argument.
- Bumped minimum supported PHP version to `>=8.2`.
- Simplified SDK constructor to a single optional `config` parameter:
  - `apiVersion` (defaults to `v2`)
  - `timeout` (seconds)
  - `httpClient` (PSR-18 client, advanced)
- Removed support for the positional `apiVersion` constructor argument.

## Safe Update (No Migration Needed)
- You can update without code changes if:
  - Your project already runs on PHP `>=8.2`.
  - You instantiate the SDK as `new Facturapi($apiKey)` (single API key argument).
  - If you use Composer, keep loading `vendor/autoload.php` as usual.
  - If you do not use Composer, load `src/Facturapi.php` directly.

## Deprecations (Non-Breaking)
- Snake_case aliases remain functional in v4, but are deprecated and will be removed in v5.
- `Facturapi_Exception` remains functional in v4 through a compatibility alias, but is deprecated and will be removed in v5.

## Improvements
- Added camelCase method names for invoice/receipt/retention actions.
- Kept snake_case aliases for transition compatibility.
- Enabled strict TLS verification by default for HTTP requests.
- `Webhooks::validateSignature()` now verifies locally by default when payload includes `body`/`payload`, `signature`, and `webhookSecret`, with automatic fallback to API validation.
- Added `ComercioExteriorCatalogs` to the main `Facturapi` client.
- Standardized constructor argument names to camelCase.
- Standardized internal protected method names to camelCase.
- Renamed exception class to `FacturapiException` and kept `Facturapi_Exception` as a compatibility alias.
