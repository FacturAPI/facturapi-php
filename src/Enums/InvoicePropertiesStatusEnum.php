<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoicePropertiesStatusEnum: string
{
    case PENDING = 'pending';
    case VALID = 'valid';
    case CANCELED = 'canceled';
    case DRAFT = 'draft';
    case FAILED = 'failed';
}
