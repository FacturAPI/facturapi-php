<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum CancellationStatus: string
{
    case NONE = 'none';
    case ACCEPTED = 'accepted';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case EXPIRED = 'expired';
}
