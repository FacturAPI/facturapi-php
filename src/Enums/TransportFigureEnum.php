<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum TransportFigureEnum: string
{
    case OPERATOR = '01';
    case OWNER = '02';
    case LESSOR = '03';
    case NOTIFIED = '04';
    case COORDINATED_MEMBER = '05';
}
