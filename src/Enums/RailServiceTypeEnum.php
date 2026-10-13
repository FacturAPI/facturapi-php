<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum RailServiceTypeEnum: string
{
    case RAILWAY_CARS = 'TS01';
    case INTERMODAL_RAILWAY_CARS = 'TS02';
    case UNIT_TRAIN_RAILWAY_CARS = 'TS03';
    case UNIT_TRAIN_INTERMODAL = 'TS04';
}
