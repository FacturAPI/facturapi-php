<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteDocumentacionAduanera
{
    public function __construct(
        public ?string $TipoDocumento = null,
        public ?string $NumPedimento = null,
        public ?string $IdentDocAduanero = null,
        public ?string $RFCImpo = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoDocumento'] ?? null,
            $data['NumPedimento'] ?? null,
            $data['IdentDocAduanero'] ?? null,
            $data['RFCImpo'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoDocumento' => $this->TipoDocumento,
            'NumPedimento' => $this->NumPedimento,
            'IdentDocAduanero' => $this->IdentDocAduanero,
            'RFCImpo' => $this->RFCImpo
        ], fn (?string $v): bool => $v !== null);
    }
}
