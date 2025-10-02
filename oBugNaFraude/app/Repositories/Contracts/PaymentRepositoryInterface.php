<?php

namespace App\Repositories\Contracts;

use App\Models\Payment; // [cite: 44]

// Esta é a interface (o contrato). [cite: 45]
interface PaymentRepositoryInterface
{
    public function create(array $data): Payment; // [cite: 49]
}