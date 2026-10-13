<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Exceptions\FacturapiException;
use Facturapi\Models\Product;
use Facturapi\Models\ProductSearchResult;

class Products
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }


    /**
     * Get all Products
     *
     * @param array|null $params Search parameters.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): ProductSearchResult
    {
        $response = $this->client->get('products', $params);
        return ProductSearchResult::fromArray($response);
    }

    /**
     * Get a Product by ID
     *
     * @param string $id Product ID.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Product
    {
        $response = $this->client->get('products/' . $id);
        return Product::fromArray($response);
    }

    /**
     * Create a Product in your organization
     *
     * @param array $params Product data.
     *
     * @throws FacturapiException
     */
    public function create(array $params): Product
    {
        $response = $this->client->post('products', $params);
        return Product::fromArray($response);
    }


    /**
     * Update a Product in your organization
     *
     * @param string $id Product ID.
     * @param array $params Product data.
     *
     * @throws FacturapiException
     */
    public function update(string $id, array $params): Product
    {
        $response = $this->client->put('products/' . $id, $params);
        return Product::fromArray($response);
    }

    /**
     * Delete a Product in your organization
     *
     * @param string $id Product ID.
     *
     * @throws FacturapiException
     */
    public function delete(string $id): Product
    {
        $response = $this->client->delete('products/' . $id);
        return Product::fromArray($response);
    }

}
