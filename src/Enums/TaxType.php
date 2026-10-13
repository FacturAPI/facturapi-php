<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum TaxType: string
{
    case IVA = 'IVA';
    case IEPS = 'IEPS';
    case ISR = 'ISR';
}
