# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [4.8.0] 2026-09-04

### Added

- Add `invoices.paymentSummary` to get the related-document object needed to build a payment complement (complemento de pago): installment number, previous balance, and taxes prorated to the paid amount.

### Fixed

- Return API error codes as strings and only normalize numeric API error codes.
