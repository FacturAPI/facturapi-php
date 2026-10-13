<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceDraftPropertiesCancellationStatusEnum: string
{
    case NONE = 'none';
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case EXPIRED = 'expired';
}
