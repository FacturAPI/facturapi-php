<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum IncotermEnum: string
{
    case CFR = 'CFR';
    case CIF = 'CIF';
    case CPT = 'CPT';
    case CIP = 'CIP';
    case DAP = 'DAP';
    case DDP = 'DDP';
    case DPU = 'DPU';
    case EXW = 'EXW';
    case FCA = 'FCA';
    case FAS = 'FAS';
    case FOB = 'FOB';
}
