<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum RetentionReadOnlyPropertiesStatusEnum: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case VALID = 'valid';
    case CANCELED = 'canceled';
}
