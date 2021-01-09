Facturapi PHP Library
=========

This is the official PHP wrapper for https://www.facturapi.io

FacturAPI makes it easy for developers to generate valid Invoices in Mexico (known as Factura Electrónica or CFDI).

If you've ever used [Stripe](https://stripe.com) or [Conekta](https://conekta.io), you'll find FacturAPI very straightforward to understand and integrate in your server app.

## Install

```bash
composer require "facturapi/facturapi-php"
```

## Before you begin

Make sure you have created your free account on [FacturAPI](https://www.facturapi.io) and that you have your **API Keys**.

## Getting started

### Import the library

Don't forget to reference the library at the top of your code:

```php
use Facturapi\Facturapi;
```

### Create a customer

```php

// Create an instance of the client.
// You can use different instances for uusing different API Keys
$facturapi = new Facturapi( FACTURAPI_KEY );

$customer = array(
  "email" => "walterwhite@gmail.com", //Optional but useful to send invoice by email
  "legal_name" => "Walter White", // Razón social
  "tax_id" => "WIWA761018", //RFC
  "address" => array(
    "zip"=> "06800",
    "street" => "Av. de los Rosales",
    "exterior" => "123",
    "neighborhood" => "Tepito"
    // city, municipality and state are filled automatically from the zip code
    // but if you want to, you can override their values
    // city: 'México',
    // municipality: 'Cuauhtémoc',
    // state: 'Ciudad de México'
  )
);

// Remember to store the customer.id in your records.
// You will need it to create an invoice for this customer.
$new_customer = $facturapi->Customers->create($customer);
```

### Create a product

```php
$facturapi = new Facturapi( FACTURAPI_KEY );
$product = array(
  "product_key" => "4319150114", // Clave Producto/Servicio from SAT's catalog. Log in to FacturAPI and use our tool to look it up.
  "description" => "Apple iPhone 8",
  "price"       => 345.60 // price in MXN.
  // By default, taxes are calculated from the price with IVA 16%
  // But again, you can override that by explicitly providing a taxes array
  // "taxes" => array(
  //   array ( "type" => \Facturapi\TaxType::IVA, "rate" => 0.16 ),
  //   array ( "type" => \Facturapi\TaxType::ISR, "rate" => 0.03666, "withholding" => true )
  // )
);

$facturapi->Products->create( $product );
```

### Create an invoice

```php
$facturapi = new Facturapi( FACTURAPI_KEY );

$invoice = array(
  "customer"     => "YOUR_CUSTOMER_ID",
  "items"        => array(
    array(
      "quantity" => 1, // Optional. Defaults to 1.
      "product"  => "YOUR_PRODUCT_ID" // You can also pass a product object instead
    ),
    array( 
      "quantity" => 2,
        "product"  => array( 
        "description" => "Guitarra",
        "product_key" => "01234567",
        "price"       => 420.69,
        "sku"         => "ABC4567"
      )
    ) // Add as many products as you want to include in your invoice
  ),
  "payment_form" => \Facturapi\PaymentForm::EFECTIVO,
  "folio_number" => "581",
  "series"       => "F"
);

$facturapi->Invoices->create( $invoice );
```

#### Download your invoice

```php
// Once you have successfully created your invoice, you can...
$facturapi = new Facturapi( FACTURAPI_KEY );

$facturapi->Invoices->download_zip("INVOICE_ID") // stream containing the PDF and XML as a ZIP file or

$facturapi->Invoices->download_pdf("INVOICE_ID") // stream containing the PDF file or

$facturapi->Invoices->download_xml("INVOICE_ID") // stream containing the XML file or
```

#### Send your invoice by email

```php
// Send the invoice to your customer's email (if any)
$facturapi = new Facturapi( FACTURAPI_KEY );

$facturapi->Invoices->send_by_email("INVOICE_ID");
```

## Documentation

There's more you can do with this library: List, retrieve, update, and remove Customers, Products and Invoices.

Visit the full documentation at http://docs.facturapi.io.

## Help

### Found a bug?

Please report it on the Issue Tracker

### Want to contribute?

Send us your PR! We appreciate your help :)

### Contact us!

contacto@facturapi.io