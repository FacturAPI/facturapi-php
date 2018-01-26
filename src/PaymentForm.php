<?php

namespace Facturapi;

class PaymentForm {
	const EFECTIVO = '01';
	const CHEQUE_NOMINATIVO = '02';
	const TRANSFERENCIA_ELECTRONICA = '03';
	const TARJETA_DE_CREDITO = '04';
	const MONEDERO_ELECTRONICO = '05';
	const DINERO_ELECTRONICO = '06';
	const VALES_DE_DESPENSA = '08';
	const DACION_EN_PAGO = '12';
	const SUBROGACION = '13';
	const CONSIGNACION = '14';
	const CONDONACION = '15';
	const COMPENSACION = '17';
	const NOVACION = '23';
	const CONFUSION = '24';
	const REMISION_DE_DEUDA = '25';
	const PRESCRIPCION_O_CADUCIDAD = '26';
	const A_SATISFACCION_DEL_ACREEDOR = '27';
	const TARJETA_DE_DEBITO = '28';
	const TARJETA_DE_SERVICIOS = '29';
	const POR_DEFINIR = '99';
}