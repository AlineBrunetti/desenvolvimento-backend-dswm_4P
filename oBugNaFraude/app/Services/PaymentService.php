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
     * Processa a transação completa, incluindo a lógica de negócio. [cite: 91]
     */
    public function processTransaction(array $data): array
    {
        // 1. LÓGICA DE DETECÇÃO DE FRAUDE
        $fraudResponse = Http::post('https://api.fraudedetect.falsa/detect', [
            'amount' => $data['amount'],
            'card_number' => $data['card_number'],
        ]);

        if ($fraudResponse->successful() && $fraudResponse->json('is_fraudulent') === true) {
            return [
                'status' => 'recusado',
                'message' => 'Transação recusada por suspeita de fraude.'
            ];
        }

        // 2. Lógica de negócio: chamada à API externa [cite: 95]
        $apiResponse = Http::post('https://api.pagamentos.falsa/process', [
            'amount' => $data['amount'],
            'card' => $data['card_number'],
        ]);

        $status = $apiResponse->successful() ? 'aprovado' : 'recusado'; // [cite: 100]

        // 3. Prepara os dados para o repositório [cite: 101]
        $paymentData = [
            'amount' => $data['amount'], // [cite: 104]
            'card_number' => Str::substr($data['card_number'], -4), // [cite: 105]
            'status' => $status, // [cite: 106]
        ];

        // 4. Persistência de dados: delega ao repositório [cite: 107]
        // Esta linha só é executada se a transação NÃO for fraudulenta
        $payment = $this->paymentRepository->create($paymentData); // [cite: 108]

        return [
            'message' => 'Transação processada com sucesso.', // [cite: 110]
            'status' => $status, // [cite: 111]
            'payment_id' => $payment->id // [cite: 114]
        ];
    }
}