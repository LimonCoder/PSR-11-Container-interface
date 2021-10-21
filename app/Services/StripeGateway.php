<?php


namespace App\Services;


class StripeGateway implements PaymentGatewayInterface
{

    public function charge()
    {
        return "Strip";
    }
}