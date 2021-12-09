<?php

namespace ActivateDeviceStrategy;

use Entity\Service;

class ActivateAllDevicesStrategy implements ActivateDeviceStrategy
{

	public function activateDevice(Service $service): Service
	{
		$service->activateDevice(Service::deviceTypes['Web']);

		if ($service->getType() == Service::TYPES['premium'] || $service->getType() == Service::TYPES['premium_lite'])
		{
			$service->activateDevice(Service::deviceTypes['Windows']);
			$service->activateDevice(Service::deviceTypes['MacOS']);
		}

		if ($service->getType() == Service::TYPES['premium'])
		{
			$service->activateDevice(Service::deviceTypes['Android']);
			$service->activateDevice(Service::deviceTypes['Ios']);
		}
		return $service;
	}
}