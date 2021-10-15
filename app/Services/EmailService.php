<?php


namespace App\Services;

class EmailService
{
    public $tax;

    public function __construct(SalesTaxService $service)
    {
        $this->tax= $service;
    }

    public function send(array $to, string $template)
    {
        return $this->tax->calculate(45, []);
    }
}
