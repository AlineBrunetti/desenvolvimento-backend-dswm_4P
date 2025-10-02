<?php

namespace App\Http\Controllers;

use App\Services\PaymentService; // [cite: 121]
use Illuminate\Http\Request; // [cite: 122]

class PaymentController extends Controller // [cite: 123]
{
    protected $paymentService; // [cite: 125]

    // O Controller agora injeta o Service [cite: 126]
    public function __construct(PaymentService $paymentService) // [cite: 128]
    {
        $this->paymentService = $paymentService; // [cite: 131]
    }

    /**
     * Processa um pagamento. [cite: 134]
     */
    public function process(Request $request) // [cite: 135]
    {
        // 1. Validação dos dados [cite: 137]
        $request->validate([
            'amount' => 'required|numeric|min:0.01', // [cite: 140]
            'card_number' => 'required|string', // [cite: 141]
            'card_holder' => 'required|string', // [cite: 142]
        ]);

        // 2. Delega a lógica de negócio completa para o Service [cite: 143]
        $result = $this->paymentService->processTransaction($request->all()); // [cite: 144]

        // 3. Retorno da resposta [cite: 145]
        return response()->json($result, 200); // [cite: 146]
    }
}