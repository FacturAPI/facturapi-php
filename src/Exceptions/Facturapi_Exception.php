<?php

namespace Facturapi\Exceptions;

require_once __DIR__ . '/FacturapiException.php';

if (!class_exists(__NAMESPACE__ . '\\Facturapi_Exception', false)) {
	class_alias(FacturapiException::class, __NAMESPACE__ . '\\Facturapi_Exception');
}
