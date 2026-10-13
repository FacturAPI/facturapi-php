<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaReceptorDirectProperties
{
    public function __construct(
        public ?string $curp = null,
        public ?string $num_seguridad_social = null,
        public ?string $fecha_inicio_rel_laboral = null,
        public mixed $antiguedad = null,
        public ?string $tipo_contrato = null,
        public ?bool $sindicalizado = null,
        public ?string $tipo_jornada = null,
        public ?string $tipo_regimen = null,
        public ?string $num_empleado = null,
        public ?string $departamento = null,
        public ?string $puesto = null,
        public ?string $riesgo_puesto = null,
        public ?string $periodicidad_pago = null,
        public ?string $banco = null,
        public ?string $cuenta_bancaria = null,
        public ?float $salario_base_cot_apor = null,
        public ?float $salario_diario_integrado = null,
        public ?string $clave_ent_fed = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['curp'] ?? null,
            $data['num_seguridad_social'] ?? null,
            $data['fecha_inicio_rel_laboral'] ?? null,
            $data['antiguedad'] ?? null,
            $data['tipo_contrato'] ?? null,
            $data['sindicalizado'] ?? false,
            $data['tipo_jornada'] ?? null,
            $data['tipo_regimen'] ?? null,
            $data['num_empleado'] ?? null,
            $data['departamento'] ?? null,
            $data['puesto'] ?? null,
            $data['riesgo_puesto'] ?? null,
            $data['periodicidad_pago'] ?? null,
            $data['banco'] ?? null,
            $data['cuenta_bancaria'] ?? null,
            $data['salario_base_cot_apor'] ?? 0,
            $data['salario_diario_integrado'] ?? 0,
            $data['clave_ent_fed'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'curp' => $this->curp,
            'num_seguridad_social' => $this->num_seguridad_social,
            'fecha_inicio_rel_laboral' => $this->fecha_inicio_rel_laboral,
            'antiguedad' => $this->antiguedad,
            'tipo_contrato' => $this->tipo_contrato,
            'sindicalizado' => $this->sindicalizado,
            'tipo_jornada' => $this->tipo_jornada,
            'tipo_regimen' => $this->tipo_regimen,
            'num_empleado' => $this->num_empleado,
            'departamento' => $this->departamento,
            'puesto' => $this->puesto,
            'riesgo_puesto' => $this->riesgo_puesto,
            'periodicidad_pago' => $this->periodicidad_pago,
            'banco' => $this->banco,
            'cuenta_bancaria' => $this->cuenta_bancaria,
            'salario_base_cot_apor' => $this->salario_base_cot_apor,
            'salario_diario_integrado' => $this->salario_diario_integrado,
            'clave_ent_fed' => $this->clave_ent_fed
        ], fn ($v): bool => $v !== null);
    }
}
