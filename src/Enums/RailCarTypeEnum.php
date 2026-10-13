<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum RailCarTypeEnum: string
{
    case BOXCAR = 'TC01';
    case GONDOLA = 'TC02';
    case HOPPER = 'TC03';
    case TANK = 'TC04';
    case INTERMODAL_PLATFORM = 'TC05';
    case GENERAL_PURPOSE_PLATFORM = 'TC06';
    case AUTOMOTIVE_PLATFORM = 'TC07';
    case LOCOMOTIVE = 'TC08';
    case SPECIAL_CAR = 'TC09';
    case PASSENGER = 'TC10';
    case TRACK_MAINTENANCE = 'TC11';
}
