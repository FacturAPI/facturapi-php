<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum CartaPorteOrCustomComplementPropertiesTypeEnum: string
{
    case CARTA_PORTE = 'carta_porte';
    case COMERCIO_EXTERIOR = 'comercio_exterior';
    case LEYENDAS_FISCALES = 'leyendas_fiscales';
    case CUSTOM = 'custom';
}
