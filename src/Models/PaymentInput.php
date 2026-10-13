<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class PaymentInput
{
    public function __construct(
        public string $payment_form,
        public array $related_documents,
        public ?string $currency = null,
        public ?float $exchange = null,
        public ?string $date = null,
        public ?string $numOperacion = null,
        public ?string $rfcEmisorCtaOrd = null,
        public ?string $nomBancoOrdExt = null,
        public ?string $ctaOrdenante = null,
        public ?string $rfcEmisorCtaBen = null,
        public ?string $ctaBeneficiario = null,
        public ?string $tipoCadPago = null,
        public ?string $certPago = null,
        public ?string $cadPago = null,
        public ?string $selloPago = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['payment_form'] ?? '',
            $data['related_documents'] ?? [],
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            $data['date'] ?? null,
            $data['numOperacion'] ?? null,
            $data['rfcEmisorCtaOrd'] ?? null,
            $data['nomBancoOrdExt'] ?? null,
            $data['ctaOrdenante'] ?? null,
            $data['rfcEmisorCtaBen'] ?? null,
            $data['ctaBeneficiario'] ?? null,
            $data['tipoCadPago'] ?? null,
            $data['certPago'] ?? null,
            $data['cadPago'] ?? null,
            $data['selloPago'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'payment_form' => $this->payment_form,
            'related_documents' => $this->related_documents,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'date' => $this->date,
            'numOperacion' => $this->numOperacion,
            'rfcEmisorCtaOrd' => $this->rfcEmisorCtaOrd,
            'nomBancoOrdExt' => $this->nomBancoOrdExt,
            'ctaOrdenante' => $this->ctaOrdenante,
            'rfcEmisorCtaBen' => $this->rfcEmisorCtaBen,
            'ctaBeneficiario' => $this->ctaBeneficiario,
            'tipoCadPago' => $this->tipoCadPago,
            'certPago' => $this->certPago,
            'cadPago' => $this->cadPago,
            'selloPago' => $this->selloPago
        ], fn (float|string|array|null $v): bool => $v !== null);
    }
}
