<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum PharmaceuticalFormsEnum: string
{
    case TABLET = '01';
    case CAPSULES = '02';
    case COMPRESSED = '03';
    case SUGAR_COATED = '04';
    case SUSPENSION = '05';
    case SOLUTION = '06';
    case EMULSION = '07';
    case SYRUP = '08';
    case INJECTABLE = '09';
    case CREAM = '10';
    case OINTMENT = '11';
    case AEROSOL = '12';
    case MEDICINAL_GAS = '13';
    case GEL = '14';
    case IMPLANT = '15';
    case OVULE = '16';
    case PATCH = '17';
    case PASTE = '18';
    case POWDER = '19';
    case SUPPOSITORY = '20';
}
