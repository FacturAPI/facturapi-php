<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum ReceiptPropertiesStatusEnum: string
{
    case OPEN = 'open';
    case CANCELED = 'canceled';
    case INVOICED_TO_CUSTOMER = 'invoiced_to_customer';
    case INVOICED_GLOBALLY = 'invoiced_globally';
}
