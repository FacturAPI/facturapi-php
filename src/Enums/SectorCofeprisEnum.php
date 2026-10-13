<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum SectorCofeprisEnum: string
{
    case MEDICINE = '01';
    case PRECURSORS_AND_DUAL_USE_CHEMICALS = '02';
    case PSYCHOTROPIC_AND_NARCOTIC = '03';
    case TOXIC_SUBSTANCES = '04';
    case PESTICIDES_AND_FERTILIZERS = '05';
}
