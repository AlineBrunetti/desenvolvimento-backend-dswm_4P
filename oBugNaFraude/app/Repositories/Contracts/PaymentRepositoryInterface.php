<?php

namespace App\Repositories\Contracts;

interface PaymentRepositoryInterface
{
    /**
     * Cria e salva um novo registro de pagamento no banco de dados.
     *
     * @param array $data
     * @return \App\Models\Payment
     */
    public function create(array $data);
}