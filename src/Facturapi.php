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
require_once 'Resources/Tools.php';

use Facturapi\Resources\Customers;
use Facturapi\Resources\Organizations;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;
use Facturapi\Resources\Receipts;
use Facturapi\Resources\Catalogs;
use Facturapi\Resources\Retentions;
use Facturapi\Resources\Tools;

class Facturapi {

	public $Customers;
	public $Organizations;
	public $Products;
	public $Invoices;
	public $Receipts;
	public $Catalogs;
	public $Retentions;
	public $Tools;

	public function __construct( $api_key, $api_version = 'v2' ) {
		$this->Customers     = new Customers( $api_key, $api_version );
		$this->Organizations = new Organizations( $api_key, $api_version );
		$this->Products      = new Products( $api_key, $api_version );
		$this->Invoices      = new Invoices( $api_key, $api_version );
		$this->Receipts      = new Receipts( $api_key, $api_version );
		$this->Catalogs      = new Catalogs( $api_key, $api_version );
		$this->Retentions    = new Retentions( $api_key, $api_version );
		$this->Tools    		 = new Tools( $api_key, $api_version );
	}
}