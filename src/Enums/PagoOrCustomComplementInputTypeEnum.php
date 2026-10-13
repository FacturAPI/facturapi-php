<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum PagoOrCustomComplementInputTypeEnum: string
{
    case NOMINA = 'nomina';
    case CUSTOM = 'custom';
}
