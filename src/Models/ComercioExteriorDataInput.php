<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ComercioExteriorDataInput
{
    public function __construct(
        public ?string $Version = null,
        public ?string $MotivoTraslado = null,
        public string $ClaveDePedimento = '',
        public int $CertificadoOrigen = 0,
        public ?string $NumCertificadoOrigen = null,
        public ?string $NumeroExportadorConfiable = null,
        public ?string $Incoterm = null,
        public ?string $Observaciones = null,
        public float $TipoCambioUSD = 0.0,
        public float $TotalUSD = 0.0,
        public mixed $Emisor = null,
        public ?array $Propietario = null,
        public mixed $Receptor = null,
        public ?array $Destinatario = null,
        public ?\Facturapi\Models\ComercioExteriorMercancias $Mercancias = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['Version'] ?? null,
            $data['MotivoTraslado'] ?? null,
            $data['ClaveDePedimento'] ?? '',
            $data['CertificadoOrigen'] ?? 0,
            $data['NumCertificadoOrigen'] ?? null,
            $data['NumeroExportadorConfiable'] ?? null,
            $data['Incoterm'] ?? null,
            $data['Observaciones'] ?? null,
            $data['TipoCambioUSD'] ?? 0,
            $data['TotalUSD'] ?? 0,
            $data['Emisor'] ?? null,
            $data['Propietario'] ?? [],
            $data['Receptor'] ?? null,
            $data['Destinatario'] ?? [],
            isset($data['Mercancias']) && is_array($data['Mercancias']) ? \Facturapi\Models\ComercioExteriorMercancias::fromArray($data['Mercancias']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Version' => $this->Version,
            'MotivoTraslado' => $this->MotivoTraslado,
            'ClaveDePedimento' => $this->ClaveDePedimento,
            'CertificadoOrigen' => $this->CertificadoOrigen,
            'NumCertificadoOrigen' => $this->NumCertificadoOrigen,
            'NumeroExportadorConfiable' => $this->NumeroExportadorConfiable,
            'Incoterm' => $this->Incoterm,
            'Observaciones' => $this->Observaciones,
            'TipoCambioUSD' => $this->TipoCambioUSD,
            'TotalUSD' => $this->TotalUSD,
            'Emisor' => $this->Emisor,
            'Propietario' => $this->Propietario,
            'Receptor' => $this->Receptor,
            'Destinatario' => $this->Destinatario,
            'Mercancias' => $this->Mercancias?->toArray()
        ], fn ($v): bool => $v !== null);
    }
}
