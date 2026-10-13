<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum RelatedResourceMessageSeverityEnum: string
{
    case ERROR = 'error';
    case WARNING = 'warning';
    case INFO = 'info';
}
