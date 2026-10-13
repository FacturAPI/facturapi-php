<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum PagoOrCustomComplementPropertiesTypeEnum: string
{
    case PAGO = 'pago';
    case CUSTOM = 'custom';
}
