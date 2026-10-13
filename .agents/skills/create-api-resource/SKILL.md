---
name: create-api-resource
description: Generates a new API Resource (DTOs, Resource Class, Methods, and Pest tests) using the official Facturapi OpenAPI specification.
---

# Create API Resource Skill

Use this skill whenever you need to add a new API resource or endpoint to the Facturapi PHP SDK.

## 1. Single Source of Truth (OpenAPI Spec)

**CRITICAL RULE:** Do NOT search for a local `.yaml` file. The SDK does not ship with a downloaded OpenAPI spec to prevent it from becoming stale. 

You MUST dynamically fetch the live OpenAPI specification using the following URL:
`https://docs.facturapi.io/redocusaurus/api-es.yaml`

Use your `read_url_content` or HTTP fetching tool to read the schema.

## 2. Generate the DTO (Data Transfer Object)

Once you understand the schema for the requested resource:
- Create a strictly typed DTO class inside `src/Models/`.
- The class must enforce `declare(strict_types=1);`.
- All properties should map to the JSON response fields exactly, but they must be strongly typed (e.g., `public string $id`, `public ?array $address`).
- Avoid using associative arrays for the return models. All new endpoints must return these strictly typed DTOs.

## 3. Generate the Resource Class

- Create a new Resource class in `src/Resources/` (e.g., `src/Resources/NewResource.php`).
- Extend `BaseResource` if applicable, or accept `FacturapiHttpClient` in the constructor.
- Add the necessary CRUD methods (`create`, `retrieve`, `all`, `delete`, etc.).
- Ensure all methods return the corresponding DTO or an array of DTOs, NEVER generic arrays.
- Handle nested structures carefully (e.g. `$response['data']` -> loop -> instantiate DTOs).

## 4. Register the Endpoint

- Open `src/Facturapi.php`.
- Add a new method (not a property!) to expose the new resource (e.g., `public function newResource(): NewResource`).
- Ensure the method utilizes lazy instantiation to avoid memory bloat.

## 5. Scaffold Tests

- Create a new Pest test file in `tests/` (e.g., `tests/NewResourceTest.php`).
- Use Pest v3's Expectation API (`expect()->toBe()`). Do NOT use PHPUnit assertions.
- Use the global helper `mockResponse(string $body, int $status = 200)` to mock the API responses instead of relying on a live network connection.
- Group the tests in a logical `describe('NewResource', function () { ... });` block.
