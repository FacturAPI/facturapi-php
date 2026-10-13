<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceIngresoInputPaymentMethodEnum: string
{
    case PUE = 'PUE';
    case PPD = 'PPD';
}
