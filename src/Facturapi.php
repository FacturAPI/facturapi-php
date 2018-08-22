<?php

namespace Facturapi;
require_once 'Resources/Customers.php';
require_once 'Resources/Organizations.php';
require_once 'Resources/Products.php';
require_once 'Resources/Invoices.php';

use Facturapi\Resources\Customers;
use Facturapi\Resources\Organizations;
use Facturapi\Resources\Products;
use Facturapi\Resources\Invoices;

class Facturapi {

	public $Customers;
	public $Organizations;
	public $Products;
	public $Invoices;

	public function __construct( $api_key ) {
		$this->Customers     = new Customers( $api_key );
		$this->Organizations = new Organizations( $api_key );
		$this->Products      = new Products( $api_key );
		$this->Invoices      = new Invoices( $api_key );
	}
}