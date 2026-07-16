4.6.0

## Added
- Add grouped constants for documented API root error codes and Facturapi-owned validation detail codes.
- Add `FacturapiException::getApiErrorCode()` for the string V2 root error code while preserving `getErrorCode()` compatibility.
- Expose structured API error metadata on `FacturapiException`, including `code`, `path`, `location`, `errors`, `logId`, and response headers.
