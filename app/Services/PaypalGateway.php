<?php


namespace App\Services;


class PaypalGateway implements PaymentGatewayInterface
{

    public function charge()
    {
        return "Paypal";
    }
}