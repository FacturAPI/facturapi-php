<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum ErrorDetailSourceEnum: string
{
    case FACTURAPI = 'facturapi';
    case SAT = 'sat';
    case PAC = 'pac';
}
