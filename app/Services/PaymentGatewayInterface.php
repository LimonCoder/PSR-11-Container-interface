<?php



namespace App\Services;

interface PaymentGatewayInterface
{
    public function charge();
}
