<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum IssuingType: string
{
    case ISSUING = 'issuing';
    case RECEIVING = 'receiving';
}
