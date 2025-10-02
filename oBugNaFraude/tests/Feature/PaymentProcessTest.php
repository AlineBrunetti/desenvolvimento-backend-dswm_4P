<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PaymentProcessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_rejects_a_fraudulent_transaction_and_does_not_save_to_database()
    {
        // Simula a API de Fraude
        Http::fake([
            'https://api.fraudedetect.falsa/detect' => Http::response(['is_fraudulent' => true], 200),
            'https://api.pagamentos.falsa/*' => Http::response([], 200),
        ]);

        $data = [
            'amount' => 100.00,
            'card_number' => '1234123412341234',
            'card_holder' => 'Test Holder',
        ];

        // Faz a requisição
        $response = $this->postJson('/api/payments', $data);

        // Verifica a resposta
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'recusado',
            'message' => 'Transação recusada por suspeita de fraude.'
        ]);

        // Verifica que nada foi salvo no banco
        $this->assertDatabaseMissing('payments', [
            'amount' => 100.00,
        ]);
    }
}