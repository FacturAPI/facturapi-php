<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum TransportTypeEnum: string
{
    case UNIT_TRUCK = 'PT01';
    case TRUCK = 'PT02';
    case TRACTOR_TRUCK = 'PT03';
    case TRAILER = 'PT04';
    case SEMI_TRAILER = 'PT05';
    case LIGHT_LOAD_VEHICLE = 'PT06';
    case CRANE = 'PT07';
    case AIRCRAFT = 'PT08';
    case SHIP_OR_VESSEL = 'PT09';
    case CAR_OR_WAGON = 'PT10';
    case CONTAINER = 'PT11';
    case LOCOMOTIVE = 'PT12';
}
