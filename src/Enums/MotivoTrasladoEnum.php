<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum MotivoTrasladoEnum: string
{
    case PRIORLY_INVOICED_GOODS_SHIPMENT = '01';
    case RELOCATION_OF_OWN_GOODS = '02';
    case CONSIGNMENT_CONTRACT_GOODS_SHIPMENT = '03';
    case GOODS_SHIPMENT_FOR_SUBSEQUENT_SALE = '04';
    case THIRD_PARTY_OWNED_GOODS_SHIPMENT = '05';
    case OTHER = '99';
}
