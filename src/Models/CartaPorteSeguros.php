<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteSeguros
{
    public function __construct(
        public ?string $AseguraRespCivil = null,
        public ?string $PolizaRespCivil = null,
        public ?string $AseguraMedAmbiente = null,
        public ?string $PolizaMedAmbiente = null,
        public ?string $AseguraCarga = null,
        public ?string $PolizaCarga = null,
        public ?float $PrimaSeguro = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['AseguraRespCivil'] ?? null,
            $data['PolizaRespCivil'] ?? null,
            $data['AseguraMedAmbiente'] ?? null,
            $data['PolizaMedAmbiente'] ?? null,
            $data['AseguraCarga'] ?? null,
            $data['PolizaCarga'] ?? null,
            $data['PrimaSeguro'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'AseguraRespCivil' => $this->AseguraRespCivil,
            'PolizaRespCivil' => $this->PolizaRespCivil,
            'AseguraMedAmbiente' => $this->AseguraMedAmbiente,
            'PolizaMedAmbiente' => $this->PolizaMedAmbiente,
            'AseguraCarga' => $this->AseguraCarga,
            'PolizaCarga' => $this->PolizaCarga,
            'PrimaSeguro' => $this->PrimaSeguro
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
