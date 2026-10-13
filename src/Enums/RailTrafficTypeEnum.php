<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum RailTrafficTypeEnum: string
{
    case LOCAL_TRAFFIC = 'TT01';
    case INTERLINE_FORWARDED_TRAFFIC = 'TT02';
    case INTERLINE_RECEIVED_TRAFFIC = 'TT03';
    case INTERLINE_TRANSIT_TRAFFIC = 'TT04';
}
