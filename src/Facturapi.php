<?php

declare(strict_types=1);

namespace Facturapi;

use Facturapi\Resources\Customers;
use Facturapi\Resources\Organizations;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;
use Facturapi\Resources\Receipts;
use Facturapi\Resources\Catalogs;
use Facturapi\Resources\CartaPorteCatalogs;
use Facturapi\Resources\ComercioExteriorCatalogs;
use Facturapi\Resources\NominaCatalogs;
use Facturapi\Resources\Retentions;
use Facturapi\Resources\Tools;
use Facturapi\Resources\Webhooks;
use Facturapi\Http\FacturapiHttpClient;

class Facturapi
{
    private ?Customers $customers = null;
    private ?Organizations $organizations = null;
    private ?Products $products = null;
    private ?Invoices $invoices = null;
    private ?Receipts $receipts = null;
    private ?Catalogs $catalogs = null;
    private ?CartaPorteCatalogs $cartaPorteCatalogs = null;
    private ?ComercioExteriorCatalogs $comercioExteriorCatalogs = null;
    private ?NominaCatalogs $nominaCatalogs = null;
    private ?Retentions $retentions = null;
    private ?Tools $tools = null;
    private ?Webhooks $webhooks = null;

    private readonly FacturapiHttpClient $httpClient;

    /**
     * @param string $apiKey Facturapi API key.
     * @param array{apiVersion?:string,httpClient?:\Psr\Http\Client\ClientInterface}|null $config
     *        Optional SDK config.
     */
    public function __construct(
        private readonly string $apiKey,
        private readonly ?array $config = null
    ) {
        $this->httpClient = new FacturapiHttpClient($this->apiKey, $this->config);
    }

    public function customers(): Customers
    {
        return $this->customers ??= new Customers($this->httpClient);
    }

    public function organizations(): Organizations
    {
        return $this->organizations ??= new Organizations($this->httpClient);
    }

    public function products(): Products
    {
        return $this->products ??= new Products($this->httpClient);
    }

    public function invoices(): Invoices
    {
        return $this->invoices ??= new Invoices($this->httpClient);
    }

    public function receipts(): Receipts
    {
        return $this->receipts ??= new Receipts($this->httpClient);
    }

    public function catalogs(): Catalogs
    {
        return $this->catalogs ??= new Catalogs($this->httpClient);
    }

    public function cartaPorteCatalogs(): CartaPorteCatalogs
    {
        return $this->cartaPorteCatalogs ??= new CartaPorteCatalogs($this->httpClient);
    }

    public function comercioExteriorCatalogs(): ComercioExteriorCatalogs
    {
        return $this->comercioExteriorCatalogs ??= new ComercioExteriorCatalogs($this->httpClient);
    }

    public function nominaCatalogs(): NominaCatalogs
    {
        return $this->nominaCatalogs ??= new NominaCatalogs($this->httpClient);
    }

    public function retentions(): Retentions
    {
        return $this->retentions ??= new Retentions($this->httpClient);
    }

    public function tools(): Tools
    {
        return $this->tools ??= new Tools($this->httpClient);
    }

    public function webhooks(): Webhooks
    {
        return $this->webhooks ??= new Webhooks($this->httpClient);
    }
}
