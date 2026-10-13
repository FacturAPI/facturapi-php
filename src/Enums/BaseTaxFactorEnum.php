<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum BaseTaxFactorEnum: string
{
    case TASA = 'Tasa';
    case CUOTA = 'Cuota';
    case EXENTO = 'Exento';
}
