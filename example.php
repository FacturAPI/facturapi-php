<?php

use Facturapi\Facturapi;

require_once 'src/Facturapi.php';


$facturapi = new Facturapi( FACTURAPI_KEY );


var_dump( $facturapi->Invoices->retrieve( "5a3f54cff508333611ad6b40" ) );

$invoice = array(
	"type"         => \Facturapi\InvoiceType::EGRESO,
	"customer"     => "5a3ff03bf508333611ad6b44",
	"items"        => array(
		array(
			"quantity" => 1,
			"product"  => "5a3f4890f508333611ad6b3f"
		),
		array(
			"quantity" => 2,
			"product"  => array(
				"description" => "Guitarra",
				"product_key" => "01234567",
				"price"       => 420.69,
				"sku"         => "ABC4567"
			)
		)
	),
	"payment_form" => \Facturapi\PaymentForm::EFECTIVO,
	"relation"     => \Facturapi\InvoiceRelation::DEVOLUCION,
	"related"      => [ 'UUID_de_factura_relacionada' ],
	"folio_number" => "581",
	"series"       => "F"
);

var_dump( $facturapi->Invoices->create( $invoice ) );

var_dump( $facturapi->Invoices->retrieve( "59914af9b1bece552fcaaafd" ) );

var_dump( $facturapi->Invoices->all() );


var_dump( $facturapi->Products->all() );

$product = array(
	"description" => "Hukulele",
	"product_key" => "60131303",
	"price"       => 345.60,
	"sku"         => "ABC1234"
);

var_dump( $facturapi->Products->create( $product ) );

$product = array(
	"description" => "Guitarra"
);

$updated_product = $facturapi->Products->update( "5a3f3e35f508333611ad6b3e", $product );
var_dump( $updated_product );

$facturapi->Products->delete( "5a3f3e35f508333611ad6b3e" );

var_dump( $facturapi->Customers->all() );


var_dump( $facturapi->Customers->retrieve( "5a3ee743f508333611ad6b3c" ) );


$customer = array(
	"email"      => "test@test.com",
	"legal_name" => "Testa Mesta",
	"tax_id"     => "RFC",
	"address"    => array(
		"zip"    => "44940",
		"street" => "Sunset Blvd"
	)
);

$new_customer = $facturapi->Customers->create( $customer );
var_dump( $new_customer );


$customer = array(
	"email"      => "testa@mestapapa.com",
	"legal_name" => "Testa Mesta Papa",
);

$updated_customer = $facturapi->Customers->update( "5a3ee743f508333611ad6b3c", $customer );
var_dump( $updated_customer );


$facturapi->Customers->delete( "5a3fefd9f508333611ad6b43" );
