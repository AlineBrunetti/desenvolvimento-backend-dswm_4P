<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider; // [cite: 192]
use App\Repositories\Contracts\PaymentRepositoryInterface; // [cite: 193]
use App\Repositories\Eloquent\EloquentPaymentRepository; // [cite: 194]

class AppServiceProvider extends ServiceProvider // [cite: 195]
{
    /**
     * Registra qualquer serviço da aplicação. [cite: 198]
     */
    public function register() // [cite: 202]
    {
        // Registrando a dependência. [cite: 204]
        $this->app->bind(
            PaymentRepositoryInterface::class, // [cite: 208]
            EloquentPaymentRepository::class // [cite: 209]
        );
    }

    /**
     * Inicia qualquer serviço da aplicação.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191); 
    }
}