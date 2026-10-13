<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum WebhookCreateEditStatusEnum: string
{
    case DISABLED = 'disabled';
    case ENABLED = 'enabled';
}
