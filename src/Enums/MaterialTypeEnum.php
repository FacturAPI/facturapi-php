<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum MaterialTypeEnum: string
{
    case RAW_MATERIAL = '01';
    case PROCESSED_MATERIAL = '02';
    case FINISHED_MATERIAL = '03';
    case MANUFACTURING_INDUSTRY_MATERIAL = '04';
    case OTHER = '05';
}
