<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class IeduComplementInput
{
    public function __construct(
        public string $nombreAlumno,
        public string $CURP,
        public string $nivelEducativo,
        public string $autRVOE,
        public ?string $rfcPago = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['nombreAlumno'] ?? '',
            $data['CURP'] ?? '',
            $data['nivelEducativo'] ?? '',
            $data['autRVOE'] ?? '',
            $data['rfcPago'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'nombreAlumno' => $this->nombreAlumno,
            'CURP' => $this->CURP,
            'nivelEducativo' => $this->nivelEducativo,
            'autRVOE' => $this->autRVOE,
            'rfcPago' => $this->rfcPago
        ], fn (?string $v): bool => $v !== null);
    }
}
