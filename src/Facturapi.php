<?php

namespace Facturapi;

use Facturapi\Resources\Customers;
use Facturapi\Resources\Organizations;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;
use Facturapi\Resources\Receipts;
use Facturapi\Resources\Catalogs;
use Facturapi\Resources\CartaPorteCatalogs;
use Facturapi\Resources\ComercioExteriorCatalogs;
use Facturapi\Resources\Retentions;
use Facturapi\Resources\Tools;
use Facturapi\Resources\Webhooks;
use Psr\Http\Client\ClientInterface;

class Facturapi
{
	public Customers $Customers;
	public Organizations $Organizations;
	public Products $Products;
	public Invoices $Invoices;
	public Receipts $Receipts;
	public Catalogs $Catalogs;
	public CartaPorteCatalogs $CartaPorteCatalogs;
	public ComercioExteriorCatalogs $ComercioExteriorCatalogs;
	public Retentions $Retentions;
	public Tools $Tools;
	public Webhooks $Webhooks;

	/**
	 * @param string $apiKey Facturapi API key.
	 * @param array{apiVersion?:string,timeout?:int|float,httpClient?:ClientInterface}|null $config
	 *        Optional SDK config. Supported keys: apiVersion, timeout, httpClient.
	 */
	public function __construct(string $apiKey, ?array $config = null)
	{
		$this->Customers = new Customers($apiKey, $config);
		$this->Organizations = new Organizations($apiKey, $config);
		$this->Products = new Products($apiKey, $config);
		$this->Invoices = new Invoices($apiKey, $config);
		$this->Receipts = new Receipts($apiKey, $config);
		$this->Catalogs = new Catalogs($apiKey, $config);
		$this->CartaPorteCatalogs = new CartaPorteCatalogs($apiKey, $config);
		$this->ComercioExteriorCatalogs = new ComercioExteriorCatalogs($apiKey, $config);
		$this->Retentions = new Retentions($apiKey, $config);
		$this->Tools = new Tools($apiKey, $config);
		$this->Webhooks = new Webhooks($apiKey, $config);
	}
}
