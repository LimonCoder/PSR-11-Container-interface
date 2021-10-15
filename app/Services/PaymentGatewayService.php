<?php



namespace App\Services;

class PaymentGatewayService
{
    public function charge(array $customer, float $amount, float $tax)
    {
        return true; //mt_rand(0, 1);
    }
}
