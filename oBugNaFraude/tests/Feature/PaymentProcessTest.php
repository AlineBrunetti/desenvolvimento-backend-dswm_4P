<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PaymentProcessTest extends TestCase
{
    use RefreshDatabase; 

    /** @test */
    public function it_rejects_a_fraudulent_transaction_and_does_not_save_to_database()
    {
        $data = [
            'amount' => 100.00,
            'card_number' => '1234567890123456',
            'card_holder' => 'Teste Fraude',
        ];

        Http::fake([
            'https://api.pagamentos.falsa/process' => Http::response([
                'is_fraudulent' => true
            ], 200),
        ]);

        $response = $this->postJson('/api/payments', $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'recusado',
            'message' => 'Transação recusada por suspeita de fraude.'
        ]);
        
        $this->assertDatabaseMissing('payments', [
            'amount' => $data['amount'],
        ]);
    }
    
    /** @test */
    public function it_approves_a_non_fraudulent_transaction_and_saves_to_database()
    {
        $data = [
            'amount' => 50.00,
            'card_number' => '1111222233334444', 
            'card_holder' => 'Teste Aprovado',
        ];

        Http::fake([
            'https://api.pagamentos.falsa/process' => Http::response([
                'is_fraudulent' => false
            ], 200),
        ]);

        $response = $this->postJson('/api/payments', $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'aprovado'
        ]);
        
        $this->assertDatabaseHas('payments', [
            'amount' => $data['amount'],
            'status' => 'aprovado',
        ]);
    }
}