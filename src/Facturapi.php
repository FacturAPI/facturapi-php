<?php

namespace Facturapi;
require_once 'Resources/Customers.php';
require_once 'Resources/Products.php';
require_once 'Resources/Invoices.php';
require_once 'Constants/PaymentForm.php';
require_once 'Constants/TaxType.php';

use Facturapi\Resources\Customers;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;

class Facturapi {

	public $Customers;
	public $Products;
	public $Invoices;

	public function __construct( $api_key ) {
		$this->Customers   = new Customers( $api_key );
		$this->Products    = new Products( $api_key );
		$this->Invoices    = new Invoices( $api_key );
	}
}