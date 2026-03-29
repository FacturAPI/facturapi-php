<?php

namespace Facturapi\Exceptions;

require_once __DIR__ . '/FacturapiException.php';

trigger_error(
	'Facturapi\\Exceptions\\Facturapi_Exception is deprecated and will be removed in v5. Use Facturapi\\Exceptions\\FacturapiException instead.',
	E_USER_DEPRECATED
);

if (!class_exists(__NAMESPACE__ . '\\Facturapi_Exception', false)) {
	class_alias(FacturapiException::class, __NAMESPACE__ . '\\Facturapi_Exception');
}
