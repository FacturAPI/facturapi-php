<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceEgresoEditInputTypeEnum: string
{
    case I = 'I';
    case E = 'E';
    case P = 'P';
    case N = 'N';
    case T = 'T';
}
