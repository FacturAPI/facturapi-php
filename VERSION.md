4.8.0

## Added
- Add `invoices.paymentSummary()` to get the related-document object needed to build a payment complement (complemento de pago): installment number, previous balance, and taxes prorated to the paid amount.

4.7.1

## Fixed
- Return numeric API error codes as strings.

4.7.0

## Added
- Add invoice ZIP request methods: `createZipRequest()`, `listZipRequests()`, `retrieveZipRequest()`, and `downloadZipRequest()`.
