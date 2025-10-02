<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Processa a transação completa, incluindo a lógica de negócio (verificação de fraude).
     */
    public function processTransaction(array $data): array
    {

        $apiResponse = Http::post('https://api.pagamentos.falsa/process', [
            'amount' => $data['amount'],
            'card' => $data['card_number'],
        ]);

        $isFraudulent = $apiResponse->successful() && $apiResponse->json('is_fraudulent') === true;
        
        if ($isFraudulent) {
            return [
                'message' => 'Transação recusada por suspeita de fraude.',
                'status' => 'recusado',
                'payment_id' => null
            ];
        }

        $status = 'aprovado';
        
        $paymentData = [
            'amount' => $data['amount'],
            'card_number' => Str::substr($data['card_number'], -4),
            'status' => $status,
        ];
        
        $payment = $this->paymentRepository->create($paymentData);

        return [
            'message' => 'Transação aprovada com sucesso.',
            'status' => $status,
            'payment_id' => $payment->id
        ];
    }
}