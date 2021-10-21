<?php


namespace App\Services;

class InvoiceService
{

    public $gateway;

    public function __construct(PaymentGatewayInterface $gatewayService)
    {

        $this->gateway = $gatewayService;

    }

    public function process()
    {
        return $this->gateway->charge();
    }
}
