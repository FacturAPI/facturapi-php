<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceZipRequestInvoiceType: string
{
    case I = 'I';
    case E = 'E';
    case T = 'T';
    case N = 'N';
    case P = 'P';
}
