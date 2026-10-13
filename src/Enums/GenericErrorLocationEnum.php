<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum GenericErrorLocationEnum: string
{
    case BODY = 'body';
    case QUERY = 'query';
    case PARAMS = 'params';
    case HEADERS = 'headers';
    case FILES = 'files';
}
