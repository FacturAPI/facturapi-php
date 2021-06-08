<?php

namespace Facturapi;
require_once 'Http/BaseClient.php';
require_once 'Exceptions/Facturapi_Exception.php';
require_once 'InvoiceRelation.php';
require_once 'InvoiceType.php';
require_once 'PaymentForm.php';
require_once 'TaxType.php';
require_once 'Resources/Customers.php';
require_once 'Resources/Organizations.php';
require_once 'Resources/Products.php';
require_once 'Resources/Invoices.php';
require_once 'Resources/Receipts.php';
require_once 'Resources/Catalogs.php';
require_once 'Resources/Retentions.php';

use Facturapi\Resources\Customers;
use Facturapi\Resources\Organizations;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;
use Facturapi\Resources\Receipts;
use Facturapi\Resources\Catalogs;
use Facturapi\Resources\Retentions;

class Facturapi {

	public $Customers;
	public $Organizations;
	public $Products;
	public $Invoices;
	public $Receipts;
	public $Catalogs;
	public $Retentions;

	public function __construct( $api_key ) {
		$this->Customers     = new Customers( $api_key );
		$this->Organizations = new Organizations( $api_key );
		$this->Products      = new Products( $api_key );
		$this->Invoices      = new Invoices( $api_key );
		$this->Receipts      = new Receipts( $api_key );
		$this->Catalogs      = new Catalogs( $api_key );
		$this->Retentions    = new Retentions( $api_key );
	}
}