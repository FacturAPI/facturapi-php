# Antigravity Agents Guidelines (AGENTS.md)

Welcome to the **Facturapi PHP SDK** project. This file provides critical context, coding standards, and instructions for AI agents working on this codebase.

## 1. Project Context & Domain Overview

- **Project**: `facturapi/facturapi-php`
- **Domain**: Official PHP SDK for [Facturapi](https://www.facturapi.io), a Mexican electronic invoicing (CFDI) API.
- **Architecture**: A standard SDK composition model. The main entry point is the `Facturapi\Facturapi` class, which acts as a factory that instantiates and exposes various API resources (e.g., Customers, Invoices, Products).

## 2. Tech Stack & Coding Standards

- **Language**: PHP >= 8.2
- **Autoloading**: PSR-4 (`Facturapi\` mapped to `src/`, `Facturapi\Tests\` mapped to `tests/`)
- **Strict Typing**: Use strict types always (`declare(strict_types=1);` at the top of every file). All properties, parameters, and returns must be strongly typed.
- **Style**: Follow PSR-12 standard conventions.
- **Dependencies**: Managed via Composer (`composer.json`). The SDK must remain completely framework-agnostic.
- **Static Analysis**: Enforced at **PHPStan Level 9** (`composer run analyze`). Code additions or refactors must pass with 0 errors without introducing artificial `ignoreErrors` in `phpstan.neon`.

## 3. Important SDK Concepts (Architecture)

- **HTTP Client**:
  - The SDK relies on PSR-18 (HTTP Client) and PSR-17 (HTTP Factories).
  - Internally, all requests are routed through `Facturapi\Http\FacturapiHttpClient`.
  - The client is strictly **framework-agnostic** and uses `php-http/discovery` to automatically find available HTTP clients in the user's project (like Guzzle or Symfony HTTP). Do not tightly couple code to Guzzle.
- **Exceptions**:
  - Errors from the API are intercepted and wrapped by the SDK into a **granular exception hierarchy**.
  - All exceptions extend `Facturapi\Exceptions\FacturapiException`.
  - Specific errors throw their respective child classes (e.g., `BadRequestException` for 400, `UnauthorizedException` for 401, `UnprocessableEntityException` for 422).
- **DTOs and Enums (Strictly Typed)**:
  - **IMPORTANT**: The SDK v5 migration is COMPLETE. ALL API endpoints now return strictly typed Data Transfer Objects (DTOs) and Enums.
  - Agents MUST NEVER write code assuming associative arrays for resource responses. Always use object property syntax (e.g., `$customer->legal_name`).
  - **Backward Compatibility via `\ArrayAccess`**: Certain nested DTOs (e.g., `CommonAddressProperties`) intentionally implement `\ArrayAccess` to ensure seamless backward compatibility with legacy array-style access (e.g., `$customer->address['zip']`). Agents must preserve these interfaces and not remove them.
- **API Endpoints (Methods vs Properties)**:
  - API interactions are handled through resource classes located in `src/Resources/`.
  - Resource classes MUST be accessed via **methods** (e.g., `$facturapi->customers()`, `$facturapi->invoices()`).
  - DO NOT use magic properties (e.g., `$facturapi->Customers`), as this syntax is deprecated and will trigger an undefined property error.
- **Statelessness (Long-Running Processes)**:
  - The SDK is 100% compatible with long-running processes (FrankenPHP, RoadRunner, Swoole) and may be resolved as a Singleton in frameworks like Laravel Octane.
  - Agents MUST NOT introduce request-specific state into the `Facturapi` or `FacturapiHttpClient` classes, as this will cause memory leaks or cross-tenant data bleed.

## 4. Testing Instructions (Pest v3)

- **Framework**: We strictly use **Pest v3** (`pestphp/pest`). PHPUnit is completely deprecated in this project.
- **Configuration & Setup**:
  - The test suite uses `tests/TestCase.php` and `tests/Pest.php` to globally inject a `FakeHttpClient` and a `Facturapi` instance into every test via `setUp()`.
  - Inside any test, the API is available as `test()->facturapi` (or `$this->facturapi`).
- **Mocking Responses**:
  - Do NOT manually instantiate `FakeHttpClient`.
  - Always use the global helper function `mockResponse(string $body, int $status = 200, array $headers = [])` at the beginning of the test.
- **Assertions (Expectation API)**:
  - Do NOT use static PHPUnit assertions (like `self::assertSame` or `self::assertTrue`).
  - You MUST use Pest's Expectation API: `expect($result)->toBe(...)`, `expect($array)->toBeArray()`, `expect($string)->toContain(...)`.
- **Exception Testing**:
  - Do NOT use `try/catch` blocks or `self::fail()` to test exceptions.
  - Use Pest's `toThrow` method passing a closure to validate internal exception data:
    ```php
    expect(fn () => $invoices->cancel('inv_123'))
        ->toThrow(function (FacturapiException $exception) {
            expect($exception->getStatusCode())->toBe(409);
        });
    ```
- **Grouping**: Always group related endpoints inside logical `describe('ResourceName', function () { ... });` blocks.

## 5. Overview of `.agents` Skills

This project contains customized AI skills to automate repetitive tasks and enforce SDK architectural standards. When working on related tasks, agents should refer to these skills:

- **SDK Maintenance & Code Generation**: `create-api-resource`
  _Use this skill whenever you need to add a new API endpoint, DTO, and Pest tests to the SDK. It explains how to scaffold the entire pipeline._

**CRITICAL - OpenAPI Single Source of Truth**:
The SDK does NOT store a local `.yaml` file. Whenever you need to read the Facturapi OpenAPI specification, you MUST fetch it directly from the live documentation site:
`https://docs.facturapi.io/redocusaurus/api-es.yaml`
Do not attempt to search for `tmp/api-es.yaml` or any local variant.

---

CO-CREATED BY INCREDE < @increde - @macarthuror>
