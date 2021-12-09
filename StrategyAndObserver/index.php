<?php

use ActivateDeviceStrategy\ActivateDeviceServiceContext;
use ActivateDeviceStrategy\ActivateMobileDevicesStrategy;
use Event\EventBus;

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});



EventBus::getInstance()->subscribe("onActivateDevice","\Helper\Subscriber::onActivateDevice");
$service=new PurchaseStrategy\PurchasePremiumStrategy();
$service=$service->purchase();
$context= ActivateDeviceServiceContext::activateDevice(new ActivateMobileDevicesStrategy(),$service);
