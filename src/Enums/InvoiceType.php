<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceType: string
{
    case INGRESO = 'I';
    case EGRESO = 'E';
    case PAGO = 'P';
    case NOMINA = 'N';
    case TRASLADO = 'T';
}
