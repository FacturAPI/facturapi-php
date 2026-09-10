4.8.1

## Fixed
- Serialize query parameters with the encoding the API documents and the other official SDKs send: lists repeat the key (`status=valid&status=canceled`) instead of using indexes, and `null` values are omitted instead of being sent empty. Associative arrays (`date[gte]=...`) and explicit empty strings (`q=`) keep working.

4.8.0

## Added
- Add `invoices.paymentSummary()` to get the related-document object needed to build a payment complement (complemento de pago): installment number, previous balance, and taxes prorated to the paid amount.

4.7.1

## Fixed
- Return numeric API error codes as strings.

4.7.0

## Added
- Add invoice ZIP request methods: `createZipRequest()`, `listZipRequests()`, `retrieveZipRequest()`, and `downloadZipRequest()`.
