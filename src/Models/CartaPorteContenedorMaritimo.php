<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteContenedorMaritimo
{
    public function __construct(
        public ?string $TipoContenedor = null,
        public ?string $MatriculaContenedor = null,
        public ?string $NumPrecinto = null,
        public ?string $IdCCPRelacionado = null,
        public ?string $PlacaVMCCP = null,
        public ?string $FechaCertificacionCCP = null,
        public ?array $RemolquesCCP = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoContenedor'] ?? null,
            $data['MatriculaContenedor'] ?? null,
            $data['NumPrecinto'] ?? null,
            $data['IdCCPRelacionado'] ?? null,
            $data['PlacaVMCCP'] ?? null,
            $data['FechaCertificacionCCP'] ?? null,
            $data['RemolquesCCP'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoContenedor' => $this->TipoContenedor,
            'MatriculaContenedor' => $this->MatriculaContenedor,
            'NumPrecinto' => $this->NumPrecinto,
            'IdCCPRelacionado' => $this->IdCCPRelacionado,
            'PlacaVMCCP' => $this->PlacaVMCCP,
            'FechaCertificacionCCP' => $this->FechaCertificacionCCP,
            'RemolquesCCP' => $this->RemolquesCCP
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
