<?php

// app/Discount/Strategies/SeasonalDiscount.php
namespace App\Discount\Strategies;

use App\Discount\DiscountStrategy;

class SeasonalDiscount implements DiscountStrategy
{
    /**
     * Calcula o desconto sazonal.
     *
     * Regra: Se o valor do pedido for maior que R$ 300,00, aplique um
     * desconto fixo de R$ 45,00. Caso contrário, aplique um desconto de R$ 10,00. [cite: 229, 230]
     *
     * @param float $orderAmount O valor total do pedido.
     * @return float O valor do desconto a ser aplicado.
     */
    public function calculate(float $orderAmount): float
    {
        if ($orderAmount > 300.00) {
            return 45.00;
        }

        return 10.00;
    }
}