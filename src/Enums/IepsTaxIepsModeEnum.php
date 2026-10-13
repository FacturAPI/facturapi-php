<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum IepsTaxIepsModeEnum: string
{
    case SUM_BEFORE_TAXES = 'sum_before_taxes';
    case BREAK_DOWN = 'break_down';
    case UNIT = 'unit';
    case SUBTRACT_BEFORE_BREAK_DOWN = 'subtract_before_break_down';
}
