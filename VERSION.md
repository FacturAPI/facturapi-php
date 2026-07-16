4.6.0

## Added
- Add grouped constants for documented API root error codes and Facturapi-owned validation detail codes.
- Fix `FacturapiException::getErrorCode()` to return only documented string API root codes.
- Expose structured API error metadata on `FacturapiException`, including `code`, `path`, `location`, `errors`, `logId`, and response headers.
