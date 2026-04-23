<?php

namespace Facturapi;

class CustomsRegimes {
	const DEFINITIVE_IMPORT = 'IMD';
	const DEFINITIVE_EXPORT = 'EXD';
	const INTERNAL_MERCHANDISE_TRANSIT = 'ITR';
	const INTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT = 'ITE';
	const EXTERNAL_MERCHANDISE_TRANSIT = 'ETR';
	const EXTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT = 'ETE';
	const FISCAL_WAREHOUSE = 'DFI';
	const STRATEGIC_FISCAL_ENCLOSURE = 'RFE';
	const FISCAL_ENCLOSURE = 'RFS';
	const CUSTOMS_TRANSIT = 'TRA';

	const DESCRIPTION = [
		self::DEFINITIVE_IMPORT => 'Importacion definitiva',
		self::DEFINITIVE_EXPORT => 'Exportacion definitiva',
		self::INTERNAL_MERCHANDISE_TRANSIT => 'Transito interno de mercancias',
		self::INTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT => 'Transito interno de mercancias para exportacion',
		self::EXTERNAL_MERCHANDISE_TRANSIT => 'Transito externo de mercancias',
		self::EXTERNAL_MERCHANDISE_TRANSIT_FOR_EXPORT => 'Transito externo de mercancias para exportacion',
		self::FISCAL_WAREHOUSE => 'Deposito fiscal',
		self::STRATEGIC_FISCAL_ENCLOSURE => 'Recinto fiscalizado estrategico',
		self::FISCAL_ENCLOSURE => 'Recinto fiscalizado',
		self::CUSTOMS_TRANSIT => 'Transito aduanero',
	];
}

class CveTransporteEnum {
	const AUTOTRANSPORT = '01';
	const NAVY_TRANSPORT = '02';
	const AIRLINE_TRANSPORT = '03';
	const RAIL_TRANSPORT = '04';
	const OTHER = '05';

	const DESCRIPTION = [
		self::AUTOTRANSPORT => 'Autotransporte',
		self::NAVY_TRANSPORT => 'Transporte Maritimo',
		self::AIRLINE_TRANSPORT => 'Transporte Aereo',
		self::RAIL_TRANSPORT => 'Transporte Ferroviario',
		self::OTHER => 'Otro',
	];
}

class TipoEstacionEnum {
	const NATIONAL_ORIGIN = '01';
	const INTERMEDIATE = '02';
	const FINAL_DESTINATION = '03';

	const DESCRIPTION = [
		self::NATIONAL_ORIGIN => 'Origen Nacional',
		self::INTERMEDIATE => 'Intermedia',
		self::FINAL_DESTINATION => 'Destino Final Nacional',
	];
}

class PermisoSctEnum {
	const FEDERAL_TRANSPORT_OF_LOAD = 'TPAF01';
	const PRIVATE_TRANSPORT_OF_LOAD = 'TPAF02';
	const FEDERAL_SPECIALIZED_HAZARDOUS_MATERIALS = 'TPAF03';
	const TRANSPORT_OF_AUTOMOBILES = 'TPAF04';
	const TRANSPORT_OF_HEAVY_LOAD_UP_TO_90_TONS = 'TPAF05';
	const TRANSPORT_OF_SPECIALIZED_HEAVY_LOAD_OVER_90_TONS = 'TPAF06';
	const PRIVATE_HAZARDOUS_MATERIALS_TRANSPORT = 'TPAF07';
	const INTERNATIONAL_LONG_HAUL_TRANSPORT = 'TPAF08';
	const INTERNATIONAL_SPECIALIZED_HAZARDOUS_LONG_HAUL = 'TPAF09';
	const FEDERAL_TRANSPORT_US_BORDER_ZONE = 'TPAF10';
	const FEDERAL_SPECIALIZED_US_BORDER_ZONE = 'TPAF11';
	const AUXILIARY_TOWING_SERVICE = 'TPAF12';
	const AUXILIARY_TOWING_AND_STORAGE_SERVICE = 'TPAF13';
	const PACKAGING_AND_COURIER_SERVICE = 'TPAF14';
	const SPECIAL_TRANSPORT_INDUSTRIAL_CRANES_UP_TO_90_TONS = 'TPAF15';
	const FEDERAL_RENTAL_COMPANIES_SERVICE = 'TPAF16';
	const VEHICLE_MOVERS_NEW_VEHICLES = 'TPAF17';
	const MANUFACTURERS_DISTRIBUTORS_NEW_VEHICLES = 'TPAF18';
	const AUTHORIZATION_DOUBLE_ARTICULATED_TRUCK = 'TPAF19';
	const FEDERAL_SPECIALIZED_FUNDS_AND_VALUES = 'TPAF20';
	const TEMPORARY_CABOTAGE_NAVIGATION = 'TPTM01';
	const NATIONAL_INTERNATIONAL_REGULAR_SERVICE_MEXICAN = 'TPTA01';
	const FOREIGN_COMPANIES_REGULAR_AIR_SERVICE = 'TPTA02';
	const NATIONAL_INTERNATIONAL_CHARTER_SERVICE = 'TPTA03';
	const NATIONAL_INTERNATIONAL_AIR_TAXI_SERVICE = 'TPTA04';
	const NOT_IN_CATALOG = 'TPXX00';

	const DESCRIPTION = [
		self::FEDERAL_TRANSPORT_OF_LOAD => 'Autotransporte Federal de carga general.',
		self::PRIVATE_TRANSPORT_OF_LOAD => 'Transporte privado de carga.',
		self::FEDERAL_SPECIALIZED_HAZARDOUS_MATERIALS => 'Autotransporte Federal de Carga Especializada de materiales y residuos peligrosos.',
		self::TRANSPORT_OF_AUTOMOBILES => 'Transporte de automoviles sin rodar en vehiculo tipo gondola.',
		self::TRANSPORT_OF_HEAVY_LOAD_UP_TO_90_TONS => 'Transporte de carga de gran peso y/o volumen de hasta 90 toneladas.',
		self::TRANSPORT_OF_SPECIALIZED_HEAVY_LOAD_OVER_90_TONS => 'Transporte de carga especializada de gran peso y/o volumen de mas 90 toneladas.',
		self::PRIVATE_HAZARDOUS_MATERIALS_TRANSPORT => 'Transporte Privado de materiales y residuos peligrosos.',
		self::INTERNATIONAL_LONG_HAUL_TRANSPORT => 'Autotransporte internacional de carga de largo recorrido.',
		self::INTERNATIONAL_SPECIALIZED_HAZARDOUS_LONG_HAUL => 'Autotransporte internacional de carga especializada de materiales y residuos peligrosos de largo recorrido.',
		self::FEDERAL_TRANSPORT_US_BORDER_ZONE => 'Autotransporte Federal de Carga General cuyo ambito de aplicacion comprende la franja fronteriza con Estados Unidos.',
		self::FEDERAL_SPECIALIZED_US_BORDER_ZONE => 'Autotransporte Federal de Carga Especializada cuyo ambito de aplicacion comprende la franja fronteriza con Estados Unidos.',
		self::AUXILIARY_TOWING_SERVICE => 'Servicio auxiliar de arrastre en las vias generales de comunicacion.',
		self::AUXILIARY_TOWING_AND_STORAGE_SERVICE => 'Servicio auxiliar de servicios de arrastre, arrastre y salvamento, y deposito de vehiculos en las vias generales de comunicacion.',
		self::PACKAGING_AND_COURIER_SERVICE => 'Servicio de paqueteria y mensajeria en las vias generales de comunicacion.',
		self::SPECIAL_TRANSPORT_INDUSTRIAL_CRANES_UP_TO_90_TONS => 'Transporte especial para el transito de gruas industriales con peso maximo de 90 toneladas.',
		self::FEDERAL_RENTAL_COMPANIES_SERVICE => 'Servicio federal para empresas arrendadoras servicio publico federal.',
		self::VEHICLE_MOVERS_NEW_VEHICLES => 'Empresas trasladistas de vehiculos nuevos.',
		self::MANUFACTURERS_DISTRIBUTORS_NEW_VEHICLES => 'Empresas fabricantes o distribuidoras de vehiculos nuevos.',
		self::AUTHORIZATION_DOUBLE_ARTICULATED_TRUCK => 'Autorizacion expresa para circular en los caminos y puentes de jurisdiccion federal con configuraciones de tractocamion doblemente articulado.',
		self::FEDERAL_SPECIALIZED_FUNDS_AND_VALUES => 'Autotransporte Federal de Carga Especializada de fondos y valores.',
		self::TEMPORARY_CABOTAGE_NAVIGATION => 'Permiso temporal para navegacion de cabotaje',
		self::NATIONAL_INTERNATIONAL_REGULAR_SERVICE_MEXICAN => 'Concesion y/o autorizacion para el servicio regular nacional y/o internacional para empresas mexicanas',
		self::FOREIGN_COMPANIES_REGULAR_AIR_SERVICE => 'Permiso para el servicio aereo regular de empresas extranjeras',
		self::NATIONAL_INTERNATIONAL_CHARTER_SERVICE => 'Permiso para el servicio nacional e internacional no regular de fletamento',
		self::NATIONAL_INTERNATIONAL_AIR_TAXI_SERVICE => 'Permiso para el servicio nacional e internacional no regular de taxi aereo',
		self::NOT_IN_CATALOG => 'Permiso no contemplado en el catalogo.',
	];
}

class SectorCofeprisEnum {
	const MEDICINE = '01';
	const PRECURSORS_AND_DUAL_USE_CHEMICALS = '02';
	const PSYCHOTROPIC_AND_NARCOTIC = '03';
	const TOXIC_SUBSTANCES = '04';
	const PESTICIDES_AND_FERTILIZERS = '05';

	const DESCRIPTION = [
		self::MEDICINE => 'Medicamento',
		self::PRECURSORS_AND_DUAL_USE_CHEMICALS => 'Precursores y quimicos de uso dual',
		self::PSYCHOTROPIC_AND_NARCOTIC => 'Psicotropicos y estupefacientes',
		self::TOXIC_SUBSTANCES => 'Sustancias toxicas',
		self::PESTICIDES_AND_FERTILIZERS => 'Plaguicidas y fertilizantes',
	];
}

class PharmaceuticalFormsEnum {
	const TABLET = '01';
	const CAPSULES = '02';
	const COMPRESSED = '03';
	const SUGAR_COATED = '04';
	const SUSPENSION = '05';
	const SOLUTION = '06';
	const EMULSION = '07';
	const SYRUP = '08';
	const INJECTABLE = '09';
	const CREAM = '10';
	const OINTMENT = '11';
	const AEROSOL = '12';
	const MEDICINAL_GAS = '13';
	const GEL = '14';
	const IMPLANT = '15';
	const OVULE = '16';
	const PATCH = '17';
	const PASTE = '18';
	const POWDER = '19';
	const SUPPOSITORY = '20';

	const DESCRIPTION = [
		self::TABLET => 'Tableta',
		self::CAPSULES => 'Capsulas',
		self::COMPRESSED => 'Comprimidos',
		self::SUGAR_COATED => 'Grageas',
		self::SUSPENSION => 'Suspension',
		self::SOLUTION => 'Solucion',
		self::EMULSION => 'Emulsion',
		self::SYRUP => 'Jarabe',
		self::INJECTABLE => 'Inyectable',
		self::CREAM => 'Crema',
		self::OINTMENT => 'Unguento',
		self::AEROSOL => 'Aerosol',
		self::MEDICINAL_GAS => 'Gas medicinal',
		self::GEL => 'Gel',
		self::IMPLANT => 'Implante',
		self::OVULE => 'Ovulo',
		self::PATCH => 'Parche',
		self::PASTE => 'Pasta',
		self::POWDER => 'Polvo',
		self::SUPPOSITORY => 'Supositorio',
	];
}

class SpecialConditionsEnum {
	const FROZEN = '01';
	const REFRIGERATED = '02';
	const CONTROLLED_TEMPERATURE = '03';
	const ROOM_TEMPERATURE = '04';

	const DESCRIPTION = [
		self::FROZEN => 'Congelados',
		self::REFRIGERATED => 'Refrigerados',
		self::CONTROLLED_TEMPERATURE => 'Temperatura controlada',
		self::ROOM_TEMPERATURE => 'Temperatura ambiente',
	];
}

class MaterialTypeEnum {
	const RAW_MATERIAL = '01';
	const PROCESSED_MATERIAL = '02';
	const FINISHED_MATERIAL = '03';
	const MANUFACTURING_INDUSTRY_MATERIAL = '04';
	const OTHER = '05';

	const DESCRIPTION = [
		self::RAW_MATERIAL => 'Materia prima',
		self::PROCESSED_MATERIAL => 'Materia procesada',
		self::FINISHED_MATERIAL => 'Materia terminada (producto terminado)',
		self::MANUFACTURING_INDUSTRY_MATERIAL => 'Materia para la industria manufacturera',
		self::OTHER => 'Otra',
	];
}

class TypeOfCustomsDocumentEnum {
	const PEDIMENT = '01';
	const TEMPORARY_IMPORT_AUTHORIZATION = '02';
	const TEMPORARY_IMPORT_AUTHORIZATION_VESSELS = '03';
	const TEMPORARY_IMPORT_AUTHORIZATION_MAINTENANCE = '04';
	const IMPORT_AUTHORIZATION_SPECIAL_VEHICLES = '05';
	const TEMPORARY_EXPORT_NOTICE = '06';
	const TRANSFER_NOTICE_IMMEX_RFE_AUTHORIZED_OPERATOR = '07';
	const TRANSFER_NOTICE_AUTO_PARTS_BORDER_ZONE = '08';
	const TEMPORARY_IMPORT_CONSTANCY_CONTAINERS = '09';
	const MERCHANDISE_TRANSFER_CONSTANCY = '10';
	const DONATION_AUTHORIZATION_FOREIGN_MERCHANDISE = '11';
	const ATA_CARNET = '12';
	const EXCHANGE_LISTS = '13';
	const TEMPORARY_IMPORT_PERMIT = '14';
	const TEMPORARY_IMPORT_PERMIT_RV = '15';
	const TEMPORARY_IMPORT_PERMIT_VESSELS = '16';
	const DONATION_REQUEST_EMERGENCIES_DISASTERS = '17';
	const CONSOLIDATED_NOTICE = '18';
	const CROSSING_NOTICE_MERCHANDISE = '19';
	const OTHER = '20';

	const DESCRIPTION = [
		self::PEDIMENT => 'Pedimento',
		self::TEMPORARY_IMPORT_AUTHORIZATION => 'Autorizacion de importacion temporal',
		self::TEMPORARY_IMPORT_AUTHORIZATION_VESSELS => 'Autorizacion de importacion temporal de embarcaciones',
		self::TEMPORARY_IMPORT_AUTHORIZATION_MAINTENANCE => 'Autorizacion de importacion temporal de mercancias, destinadas al mantenimiento y reparacion de las mercancias importadas temporalmente',
		self::IMPORT_AUTHORIZATION_SPECIAL_VEHICLES => 'Autorizacion para la importacion de vehiculos especialmente construidos o transformados, equipados con dispositivos o aparatos diversos para cumplir con contrato derivado de licitacion publica',
		self::TEMPORARY_EXPORT_NOTICE => 'Aviso de exportacion temporal',
		self::TRANSFER_NOTICE_IMMEX_RFE_AUTHORIZED_OPERATOR => 'Aviso de traslado de mercancias de empresas con Programa IMMEX, RFE u Operador Economico Autorizado',
		self::TRANSFER_NOTICE_AUTO_PARTS_BORDER_ZONE => 'Aviso para el traslado de autopartes ubicadas en la franja o region fronteriza a la industria terminal automotriz o manufacturera de vehiculos de autotransporte en el resto del territorio nacional',
		self::TEMPORARY_IMPORT_CONSTANCY_CONTAINERS => 'Constancia de importacion temporal, retorno o transferencia de contenedores',
		self::MERCHANDISE_TRANSFER_CONSTANCY => 'Constancia de transferencia de mercancias',
		self::DONATION_AUTHORIZATION_FOREIGN_MERCHANDISE => 'Autorizacion de donacion de mercancias al Fisco Federal que se encuentren en el extranjero',
		self::ATA_CARNET => 'Cuaderno ATA',
		self::EXCHANGE_LISTS => 'Listas de intercambio',
		self::TEMPORARY_IMPORT_PERMIT => 'Permiso de Importacion Temporal',
		self::TEMPORARY_IMPORT_PERMIT_RV => 'Permiso de importacion temporal de casa rodante',
		self::TEMPORARY_IMPORT_PERMIT_VESSELS => 'Permiso de importacion temporal de embarcaciones',
		self::DONATION_REQUEST_EMERGENCIES_DISASTERS => 'Solicitud de donacion de mercancias en casos de emergencias o desastres naturales',
		self::CONSOLIDATED_NOTICE => 'Aviso de consolidado',
		self::CROSSING_NOTICE_MERCHANDISE => 'Aviso de cruce de mercancias',
		self::OTHER => 'Otro',
	];
}

class TransportTypeEnum {
	const UNIT_TRUCK = 'PT01';
	const TRUCK = 'PT02';
	const TRACTOR_TRUCK = 'PT03';
	const TRAILER = 'PT04';
	const SEMI_TRAILER = 'PT05';
	const LIGHT_LOAD_VEHICLE = 'PT06';
	const CRANE = 'PT07';
	const AIRCRAFT = 'PT08';
	const SHIP_OR_VESSEL = 'PT09';
	const CAR_OR_WAGON = 'PT10';
	const CONTAINER = 'PT11';
	const LOCOMOTIVE = 'PT12';

	const DESCRIPTION = [
		self::UNIT_TRUCK => 'Camion unitario',
		self::TRUCK => 'Camion',
		self::TRACTOR_TRUCK => 'Tractocamion',
		self::TRAILER => 'Remolque',
		self::SEMI_TRAILER => 'Semirremolque',
		self::LIGHT_LOAD_VEHICLE => 'Vehiculo ligero de carga',
		self::CRANE => 'Grua',
		self::AIRCRAFT => 'Aeronave',
		self::SHIP_OR_VESSEL => 'Barco o buque',
		self::CAR_OR_WAGON => 'Carro o vagon',
		self::CONTAINER => 'Contenedor',
		self::LOCOMOTIVE => 'Locomotora',
	];
}

class TransportFigureEnum {
	const OPERATOR = '01';
	const OWNER = '02';
	const LESSOR = '03';
	const NOTIFIED = '04';
	const COORDINATED_MEMBER = '05';

	const DESCRIPTION = [
		self::OPERATOR => 'Operador',
		self::OWNER => 'Propietario',
		self::LESSOR => 'Arrendador',
		self::NOTIFIED => 'Notificado',
		self::COORDINATED_MEMBER => 'Integrante de Coordinados',
	];
}

class RegistroIstmoEnum {
	const COATZACOALCOS_I = '01';
	const COATZACOALCOS_II = '02';
	const TEXISTEPEC = '03';
	const SAN_JUAN_EVANGELISTA = '04';
	const SALINA_CRUZ = '05';
	const SAN_BLAS_ATEMPA = '06';

	const DESCRIPTION = [
		self::COATZACOALCOS_I => 'Coatzacoalcos I',
		self::COATZACOALCOS_II => 'Coatzacoalcos II',
		self::TEXISTEPEC => 'Texistepec',
		self::SAN_JUAN_EVANGELISTA => 'San Juan Evangelista',
		self::SALINA_CRUZ => 'Salina Cruz',
		self::SAN_BLAS_ATEMPA => 'San Blas Atempa',
	];
}

class LoadingKey {
	const GENERAL_LOOSE_CARGO = 'CGS';
	const GENERAL_CONTAINERIZED_CARGO = 'CGC';
	const BULK_MINERAL = 'GMN';
	const AGRICULTURAL_BULK = 'GAG';
	const OTHER_FLUIDS = 'OFL';
	const OIL_AND_DERIVATIVES = 'PYD';

	const DESCRIPTION = [
		self::GENERAL_LOOSE_CARGO => 'Carga General Suelta',
		self::GENERAL_CONTAINERIZED_CARGO => 'Carga General Contenerizada',
		self::BULK_MINERAL => 'Gran Mineral',
		self::AGRICULTURAL_BULK => 'Granel Agricola',
		self::OTHER_FLUIDS => 'Otros Fluidos',
		self::OIL_AND_DERIVATIVES => 'Petroleo y Derivados',
	];
}

class ConfigMaritimaEnum {
	const SUPPLIER = 'B01';
	const BARGE = 'B02';
	const BULK_CARRIER = 'B03';
	const CONTAINER_SHIP = 'B04';
	const DREDGER = 'B05';
	const FISHING = 'B06';
	const GENERAL_CARGO = 'B07';
	const CHEMICAL_TANKER = 'B08';
	const FERRY = 'B09';
	const RO_RO = 'B10';
	const RESEARCH = 'B11';
	const TANKER = 'B12';
	const GAS_CARRIER = 'B13';
	const TUG = 'B14';
	const EXTRAORDINARY_SPECIALIZATION = 'B15';

	const DESCRIPTION = [
		self::SUPPLIER => 'Abastecedor',
		self::BARGE => 'Barcaza',
		self::BULK_CARRIER => 'Granelero',
		self::CONTAINER_SHIP => 'Porta Contenedor',
		self::DREDGER => 'Draga',
		self::FISHING => 'Pesquero',
		self::GENERAL_CARGO => 'Carga General',
		self::CHEMICAL_TANKER => 'Quimiqueros',
		self::FERRY => 'Transbordadores',
		self::RO_RO => 'Carga RoRo',
		self::RESEARCH => 'Investigacion',
		self::TANKER => 'Tanquero',
		self::GAS_CARRIER => 'Gasero',
		self::TUG => 'Remolcador',
		self::EXTRAORDINARY_SPECIALIZATION => 'Extraordinaria especializacion',
	];
}

class RailTrafficTypeEnum {
	const LOCAL_TRAFFIC = 'TT01';
	const INTERLINE_FORWARDED_TRAFFIC = 'TT02';
	const INTERLINE_RECEIVED_TRAFFIC = 'TT03';
	const INTERLINE_TRANSIT_TRAFFIC = 'TT04';

	const DESCRIPTION = [
		self::LOCAL_TRAFFIC => 'Trafico local',
		self::INTERLINE_FORWARDED_TRAFFIC => 'Trafico interlineal remitido',
		self::INTERLINE_RECEIVED_TRAFFIC => 'Trafico interlineal recibido',
		self::INTERLINE_TRANSIT_TRAFFIC => 'Trafico interlineal en transito',
	];
}

class ContainerTypeEnum {
	const CONTAINER_20FT = 'TC01';
	const CONTAINER_40FT = 'TC02';
	const CONTAINER_45FT = 'TC03';
	const CONTAINER_48FT = 'TC04';
	const CONTAINER_53FT = 'TC05';

	const DESCRIPTION = [
		self::CONTAINER_20FT => 'Contenedor de 6.1 Mts de longitud',
		self::CONTAINER_40FT => 'Contenedor de 12.2 Mts de longitud',
		self::CONTAINER_45FT => 'Contenedor de 13.7 Mts de longitud',
		self::CONTAINER_48FT => 'Contenedor de 14.6 Mts de longitud',
		self::CONTAINER_53FT => 'Contenedor de 16.1 Mts de longitud',
	];
}

class MaritimeContainerTypeEnum {
	const REFRIGERATED_20FT = 'CM001';
	const REFRIGERATED_40FT = 'CM002';
	const STANDARD_8FT = 'CM003';
	const STANDARD_10FT = 'CM004';
	const STANDARD_20FT = 'CM005';
	const STANDARD_40FT = 'CM006';
	const OPEN_SIDE = 'CM007';
	const ISOTANK = 'CM008';
	const FLAT_RACKS = 'CM009';
	const TANKER_SHIP = 'CM010';
	const FERRY = 'CM011';
	const TOURIST_FERRY = 'CM012';

	const DESCRIPTION = [
		self::REFRIGERATED_20FT => 'Contenedores refrigerados de 20FT',
		self::REFRIGERATED_40FT => 'Contenedores refrigerados de 40FT',
		self::STANDARD_8FT => 'Contenedores estandar de 8FT',
		self::STANDARD_10FT => 'Contenedores estandar de 10FT',
		self::STANDARD_20FT => 'Contenedores estandar de 20FT',
		self::STANDARD_40FT => 'Contenedores estandar de 40FT',
		self::OPEN_SIDE => 'Contenedores Open Side',
		self::ISOTANK => 'Contenedor Isotanque',
		self::FLAT_RACKS => 'Contenedor flat racks',
		self::TANKER_SHIP => 'Buque tanque',
		self::FERRY => 'Ferri',
		self::TOURIST_FERRY => 'Ferri - Turistico y vacios',
	];
}

class RailCarTypeEnum {
	const BOXCAR = 'TC01';
	const GONDOLA = 'TC02';
	const HOPPER = 'TC03';
	const TANK = 'TC04';
	const INTERMODAL_PLATFORM = 'TC05';
	const GENERAL_PURPOSE_PLATFORM = 'TC06';
	const AUTOMOTIVE_PLATFORM = 'TC07';
	const LOCOMOTIVE = 'TC08';
	const SPECIAL_CAR = 'TC09';
	const PASSENGER = 'TC10';
	const TRACK_MAINTENANCE = 'TC11';

	const DESCRIPTION = [
		self::BOXCAR => 'Furgon',
		self::GONDOLA => 'Gondola',
		self::HOPPER => 'Tolva',
		self::TANK => 'Tanque',
		self::INTERMODAL_PLATFORM => 'Plataforma Intermodal',
		self::GENERAL_PURPOSE_PLATFORM => 'Plataforma de Uso General',
		self::AUTOMOTIVE_PLATFORM => 'Plataforma Automotriz',
		self::LOCOMOTIVE => 'Locomotora',
		self::SPECIAL_CAR => 'Carro Especial',
		self::PASSENGER => 'Pasajeros',
		self::TRACK_MAINTENANCE => 'Mantenimiento de Via',
	];
}

class RailServiceTypeEnum {
	const RAILWAY_CARS = 'TS01';
	const INTERMODAL_RAILWAY_CARS = 'TS02';
	const UNIT_TRAIN_RAILWAY_CARS = 'TS03';
	const UNIT_TRAIN_INTERMODAL = 'TS04';
}

class MotivoTrasladoEnum {
	const PRIORLY_INVOICED_GOODS_SHIPMENT = '01';
	const RELOCATION_OF_OWN_GOODS = '02';
	const CONSIGNMENT_CONTRACT_GOODS_SHIPMENT = '03';
	const GOODS_SHIPMENT_FOR_SUBSEQUENT_SALE = '04';
	const THIRD_PARTY_OWNED_GOODS_SHIPMENT = '05';
	const OTHER = '99';

	const DESCRIPTION = [
		self::PRIORLY_INVOICED_GOODS_SHIPMENT => 'Envio de mercancias facturadas con anterioridad',
		self::RELOCATION_OF_OWN_GOODS => 'Reubicacion de mercancias propias',
		self::CONSIGNMENT_CONTRACT_GOODS_SHIPMENT => 'Envio de mercancias objeto de contrato de consignacion',
		self::GOODS_SHIPMENT_FOR_SUBSEQUENT_SALE => 'Envio de mercancias para posterior enajenacion',
		self::THIRD_PARTY_OWNED_GOODS_SHIPMENT => 'Envio de mercancias propiedad de terceros',
		self::OTHER => 'Otros',
	];
}

class IncotermEnum {
	const CFR = 'CFR';
	const CIF = 'CIF';
	const CPT = 'CPT';
	const CIP = 'CIP';
	const DAP = 'DAP';
	const DDP = 'DDP';
	const DPU = 'DPU';
	const EXW = 'EXW';
	const FCA = 'FCA';
	const FAS = 'FAS';
	const FOB = 'FOB';

	const DESCRIPTION = [
		self::CFR => 'Coste y flete (puerto de destino convenido).',
		self::CIF => 'Coste, seguro y flete (puerto de destino convenido).',
		self::CPT => 'Transporte pagado hasta (el lugar de destino convenido).',
		self::CIP => 'Transporte y seguro pagados hasta (lugar de destino convenido).',
		self::DAP => 'Entregada en lugar.',
		self::DDP => 'Entregada derechos pagados (lugar de destino convenido).',
		self::DPU => 'Entregada y descargada en lugar acordado.',
		self::EXW => 'En fabrica (lugar convenido).',
		self::FCA => 'Franco transportista (lugar designado).',
		self::FAS => 'Franco al costado del buque (puerto de carga convenido).',
		self::FOB => 'Franco a bordo (puerto de carga convenido).',
	];
}

class UnidadAduanaEnum {
	const KILO = '01';
	const GRAMO = '02';
	const METRO_LINEAL = '03';
	const METRO_CUADRADO = '04';
	const METRO_CUBICO = '05';
	const PIEZA = '06';
	const CABEZA = '07';
	const LITRO = '08';
	const PAR = '09';
	const KILOWATT = '10';
	const MILLAR = '11';
	const JUEGO = '12';
	const KILOWATT_HORA = '13';
	const TONELADA = '14';
	const BARRIL = '15';
	const GRAMO_NETO = '16';
	const DECENAS = '17';
	const CIENTOS = '18';
	const DOCENAS = '19';
	const CAJA = '20';
	const BOTELLA = '21';
	const CARAT = '22';
	const SERVICIO = '99';

	const DESCRIPTION = [
		self::KILO => 'KILO',
		self::GRAMO => 'GRAMO',
		self::METRO_LINEAL => 'METRO LINEAL',
		self::METRO_CUADRADO => 'METRO CUADRADO',
		self::METRO_CUBICO => 'METRO CUBICO',
		self::PIEZA => 'PIEZA',
		self::CABEZA => 'CABEZA',
		self::LITRO => 'LITRO',
		self::PAR => 'PAR',
		self::KILOWATT => 'KILOWATT',
		self::MILLAR => 'MILLAR',
		self::JUEGO => 'JUEGO',
		self::KILOWATT_HORA => 'KILOWATT/HORA',
		self::TONELADA => 'TONELADA',
		self::BARRIL => 'BARRIL',
		self::GRAMO_NETO => 'GRAMO NETO',
		self::DECENAS => 'DECENAS',
		self::CIENTOS => 'CIENTOS',
		self::DOCENAS => 'DOCENAS',
		self::CAJA => 'CAJA',
		self::BOTELLA => 'BOTELLA',
		self::CARAT => 'CARAT',
		self::SERVICIO => 'SERVICIO',
	];
}
