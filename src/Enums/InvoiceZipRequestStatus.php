<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceZipRequestStatus: string
{
    case CREATED = 'created';
    case PROCESSING = 'processing';
    case FINISHED = 'finished';
    case FAILED = 'failed';
    case NONE = 'none';
}
