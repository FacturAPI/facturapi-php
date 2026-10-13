<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum WebhookPropertiesStatusEnum: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}
