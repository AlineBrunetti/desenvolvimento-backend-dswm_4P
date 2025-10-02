<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment; // [cite: 54]
use App\Repositories\Contracts\PaymentRepositoryInterface; // [cite: 55]

class EloquentPaymentRepository implements PaymentRepositoryInterface // [cite: 58]
{
    /**
     * Cria um novo registro de pagamento no banco de dados. [cite: 61]
     */
    public function create(array $data): Payment // [cite: 62]
    {
        return Payment::create($data); // [cite: 65]
    }
}