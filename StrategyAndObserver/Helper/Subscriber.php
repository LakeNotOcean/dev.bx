<?php

namespace Helper;

use Entity\Service;

class Subscriber
{
	public static function onUserAdd($data)
	{
		echo $data->getId() . PHP_EOL;
	}
	public static function onUserUpdate($data)
	{
		echo $data->getName() . PHP_EOL;
	}
	public static function onActivateDevice(Service $service)
	{
		$devices=$service->getActivatedDevices();
		echo "list of codes of activated devices : ".PHP_EOL;
		foreach ($devices as $device)
		{
			echo $device.PHP_EOL;
		}
	}
}