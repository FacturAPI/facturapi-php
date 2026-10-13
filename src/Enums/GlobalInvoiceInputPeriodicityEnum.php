<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum GlobalInvoiceInputPeriodicityEnum: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case FORTNIGHT = 'fortnight';
    case MONTH = 'month';
    case TWO_MONTHS = 'two_months';
}
