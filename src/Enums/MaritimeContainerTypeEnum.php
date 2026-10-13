<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum MaritimeContainerTypeEnum: string
{
    case REFRIGERATED_20FT = 'CM001';
    case REFRIGERATED_40FT = 'CM002';
    case STANDARD_8FT = 'CM003';
    case STANDARD_10FT = 'CM004';
    case STANDARD_20FT = 'CM005';
    case STANDARD_40FT = 'CM006';
    case OPEN_SIDE = 'CM007';
    case ISOTANK = 'CM008';
    case FLAT_RACKS = 'CM009';
    case TANKER_SHIP = 'CM010';
    case FERRY = 'CM011';
    case TOURIST_FERRY = 'CM012';
}
