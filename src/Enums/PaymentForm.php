<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum PaymentForm: string
{
    case EFECTIVO = '01';
    case CHEQUE_NOMINATIVO = '02';
    case TRANSFERENCIA_ELECTRONICA = '03';
    case TARJETA_DE_CREDITO = '04';
    case MONEDERO_ELECTRONICO = '05';
    case DINERO_ELECTRONICO = '06';
    case VALES_DE_DESPENSA = '08';
    case DACION_EN_PAGO = '12';
    case SUBROGACION = '13';
    case CONSIGNACION = '14';
    case CONDONACION = '15';
    case COMPENSACION = '17';
    case NOVACION = '23';
    case CONFUSION = '24';
    case REMISION_DE_DEUDA = '25';
    case PRESCRIPCION_O_CADUCIDAD = '26';
    case A_SATISFACCION_DEL_ACREEDOR = '27';
    case TARJETA_DE_DEBITO = '28';
    case TARJETA_DE_SERVICIOS = '29';
    case POR_DEFINIR = '99';
}
