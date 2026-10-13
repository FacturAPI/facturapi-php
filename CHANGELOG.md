# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [5.0.0] - 2026-10-11

### Changed

- **BREAKING CHANGE**: All API resources now return strictly typed DTOs and Enums instead of generic associative arrays.
- **BREAKING CHANGE**: API resources are now accessed via methods (e.g. `$facturapi->customers()`) instead of magic properties (e.g. `$facturapi->Customers`).
- **BREAKING CHANGE**: Changed the internal HTTP client implementation (requires PSR-18 compatible client).
- **BREAKING CHANGE**: Required PHP version is strictly enforced to PHP >= 8.2.

## [4.8.0] 2026-09-04

### Added

- Add `invoices.paymentSummary` to get the related-document object needed to build a payment complement (complemento de pago): installment number, previous balance, and taxes prorated to the paid amount.

## [4.7.1] 2026-08-24

### Fixed

- Return API error codes as strings and only normalize numeric API error codes.
