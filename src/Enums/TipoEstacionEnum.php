<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum TipoEstacionEnum: string
{
    case NATIONAL_ORIGIN = '01';
    case INTERMEDIATE = '02';
    case FINAL_DESTINATION = '03';
}
