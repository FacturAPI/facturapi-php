<?php

declare(strict_types=1);

namespace Facturapi\Enums;

enum UnidadAduanaEnum: string
{
    case KILO = '01';
    case GRAMO = '02';
    case METRO_LINEAL = '03';
    case METRO_CUADRADO = '04';
    case METRO_CUBICO = '05';
    case PIEZA = '06';
    case CABEZA = '07';
    case LITRO = '08';
    case PAR = '09';
    case KILOWATT = '10';
    case MILLAR = '11';
    case JUEGO = '12';
    case KILOWATT_HORA = '13';
    case TONELADA = '14';
    case BARRIL = '15';
    case GRAMO_NETO = '16';
    case DECENAS = '17';
    case CIENTOS = '18';
    case DOCENAS = '19';
    case CAJA = '20';
    case BOTELLA = '21';
    case CARAT = '22';
    case SERVICIO = '99';
}
