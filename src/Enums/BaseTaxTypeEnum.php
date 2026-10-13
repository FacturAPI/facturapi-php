<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum BaseTaxTypeEnum: string
{
    case IVA = 'IVA';
    case ISR = 'ISR';
    case IEPS = 'IEPS';
}
