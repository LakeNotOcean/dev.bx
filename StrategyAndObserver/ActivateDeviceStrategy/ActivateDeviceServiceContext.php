<?php

namespace ActivateDeviceStrategy;

use Entity\Service;
use Event\EventBus;

class ActivateDeviceServiceContext
{
	public static function activateDevice(ActivateDeviceStrategy $strategy, Service $service)
	{
		$service = $strategy->activateDevice($service);
		EventBus::getInstance()->publish("onActivateDevice", $service);
		return $service;
	}
}