<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum CustomsRegimes: string
{
    case DEFINITIVE_IMPORT = 'IMD';
    case DEFINITIVE_EXPORT = 'EXD';
    case INTERNAL_MERCHANDISE_TRANSIT = 'ITR';
    case INTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT = 'ITE';
    case EXTERNAL_MERCHANDISE_TRANSIT = 'ETR';
    case EXTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT = 'ETE';
    case FISCAL_WAREHOUSE = 'DFI';
    case STRATEGIC_FISCAL_ENCLOSURE = 'RFE';
    case FISCAL_ENCLOSURE = 'RFS';
    case CUSTOMS_TRANSIT = 'TRA';
}
