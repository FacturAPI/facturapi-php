<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum ContainerTypeEnum: string
{
    case CONTAINER_20FT = 'TC01';
    case CONTAINER_40FT = 'TC02';
    case CONTAINER_45FT = 'TC03';
    case CONTAINER_48FT = 'TC04';
    case CONTAINER_53FT = 'TC05';
}
