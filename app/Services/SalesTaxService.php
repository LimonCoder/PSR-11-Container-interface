<?php

namespace App\Services;

class SalesTaxService
{
    public function calculate(float $amount, array $customer)
    {

        return $amount * 6.5 / 100;
    }
}
