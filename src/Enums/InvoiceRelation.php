<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum InvoiceRelation: string
{
    case NOTA_DE_CREDITO = '01';
    case NOTA_DE_DEBITO = '02';
    case DEVOLUCION = '03';
    case SUSTITUCION = '04';
    case TRASLADOS = '05';
    case FACTURA_POR_TRASLADOS = '06';
    case CDFI_POR_ANTICIPO = '07';
    case FACTURA_POR_PARCIALIDADES = '08';
    case FACTURA_POR_DIFERIDOS = '09';
}
