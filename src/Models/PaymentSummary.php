<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class PaymentSummary
{
    public function __construct(
        public ?string $uuid = null,
        public ?int $installment = null,
        public ?float $last_balance = null,
        public ?float $total = null,
        public ?string $currency = null,
        public ?float $amount = null,
        public ?array $taxes = null,
        public ?int $folio_number = null,
        public ?string $series = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['uuid'] ?? null,
            $data['installment'] ?? null,
            isset($data['last_balance']) ? (float) $data['last_balance'] : 0.0,
            isset($data['total']) ? (float) $data['total'] : 0.0,
            $data['currency'] ?? null,
            isset($data['amount']) ? (float) $data['amount'] : 0.0,
            $data['taxes'] ?? [],
            $data['folio_number'] ?? null,
            $data['series'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'uuid' => $this->uuid,
            'installment' => $this->installment,
            'last_balance' => $this->last_balance,
            'total' => $this->total,
            'currency' => $this->currency,
            'amount' => $this->amount,
            'taxes' => $this->taxes,
            'folio_number' => $this->folio_number,
            'series' => $this->series,
        ], fn ($v): bool => $v !== null);
    }
}
