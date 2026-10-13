<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum SpecialConditionsEnum: string
{
    case FROZEN = '01';
    case REFRIGERATED = '02';
    case CONTROLLED_TEMPERATURE = '03';
    case ROOM_TEMPERATURE = '04';
}
