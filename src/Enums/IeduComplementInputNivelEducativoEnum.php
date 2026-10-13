<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum IeduComplementInputNivelEducativoEnum: string
{
    case PREESCOLAR = 'Preescolar';
    case PRIMARIA = 'Primaria';
    case SECUNDARIA = 'Secundaria';
    case PROFESIONAL_T__CNICO = 'Profesional técnico';
    case BACHILLERATO_O_SU_EQUIVALENTE = 'Bachillerato o su equivalente';
}
