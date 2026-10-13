<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum CveTransporteEnum: string
{
    case AUTOTRANSPORT = '01';
    case NAVY_TRANSPORT = '02';
    case AIRLINE_TRANSPORT = '03';
    case RAIL_TRANSPORT = '04';
    case OTHER = '05';
}
