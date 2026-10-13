<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceCommonInputPropertiesStatusEnum: string
{
    case PENDING = 'pending';
    case DRAFT = 'draft';
}
