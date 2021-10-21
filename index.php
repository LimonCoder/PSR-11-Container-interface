<?php

require_once 'vendor\autoload.php';

use App\Core\Container;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayInterface;
use App\Services\StripeGateway;
use App\Services\PaypalGateway;

$container = new Container();

$container->set(PaymentGatewayInterface::class,StripeGateway::class);

$obj = $container->get(InvoiceService::class);

echo $obj->process();

