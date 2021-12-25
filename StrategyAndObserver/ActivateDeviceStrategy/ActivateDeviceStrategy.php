<?php

namespace ActivateDeviceStrategy;

use Entity\Service;

interface ActivateDeviceStrategy
{
	public function activateDevice(Service $service):Service;

}