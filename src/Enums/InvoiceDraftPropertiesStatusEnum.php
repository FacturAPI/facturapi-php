<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceDraftPropertiesStatusEnum: string
{
    case PENDING = 'pending';
    case VALID = 'valid';
    case CANCELED = 'canceled';
    case DRAFT = 'draft';
}
