<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Eloquent\EloquentPaymentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra qualquer serviço da aplicação.
     */
    public function register(): void
    {
        $this->app->bind(
            PaymentRepositoryInterface::class,
            EloquentPaymentRepository::class
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