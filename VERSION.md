4.7.0

## Added
- Add invoice ZIP request methods: `createZipRequest()`, `listZipRequests()`, `retrieveZipRequest()`, and `downloadZipRequest()`.

4.6.0

## Added
- Add draft support methods for retentions: `updateDraft()`, `copyToDraft()`, and `stampDraft()`.
- Allow `Retentions::cancel()` to be called without query parameters for deleting draft retentions.

4.5.0

## Added
- Expose structured API error metadata on `FacturapiException`, including `code`, `path`, `location`, `errors`, `logId`, and response headers.
