<?php

namespace ActivateDeviceStrategy;

use Entity\Service;

class ActivateMobileDevicesStrategy implements ActivateDeviceStrategy
{

	public function activateDevice(Service $service): Service
	{
		if ($service->getType()!==Service::TYPES["premium"])
		{
			trigger_error("Service is not premium",E_USER_WARNING);
			return $service;
		}
		$service->activateDevice(Service::deviceTypes['Android']);
		$service->activateDevice(Service::deviceTypes['Ios']);
		return $service;
	}
}