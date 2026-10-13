<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum ConfigMaritimaEnum: string
{
    case SUPPLIER = 'B01';
    case BARGE = 'B02';
    case BULK_CARRIER = 'B03';
    case CONTAINER_SHIP = 'B04';
    case DREDGER = 'B05';
    case FISHING = 'B06';
    case GENERAL_CARGO = 'B07';
    case CHEMICAL_TANKER = 'B08';
    case FERRY = 'B09';
    case RO_RO = 'B10';
    case RESEARCH = 'B11';
    case TANKER = 'B12';
    case GAS_CARRIER = 'B13';
    case TUG = 'B14';
    case EXTRAORDINARY_SPECIALIZATION = 'B15';
}
