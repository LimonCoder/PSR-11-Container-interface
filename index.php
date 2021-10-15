<?php

require_once 'vendor\autoload.php';

use App\Core\Container;
use App\Services\EmailService;

$container = new Container();

$obj = $container->get(EmailService::class);

echo $obj->send([],'');