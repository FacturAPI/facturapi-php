<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum LoadingKey: string
{
    case GENERAL_LOOSE_CARGO = 'CGS';
    case GENERAL_CONTAINERIZED_CARGO = 'CGC';
    case BULK_MINERAL = 'GMN';
    case AGRICULTURAL_BULK = 'GAG';
    case OTHER_FLUIDS = 'OFL';
    case OIL_AND_DERIVATIVES = 'PYD';
}
