<?php

namespace Adapter;

use Entity\Advertisement;
use Entity\AdvertisementResponse;
use FbExternal\FbAdvertisement;
use FbExternal\FbPublicator;
use Service\AdvertisementProviderInterface;

class FbAdvertisementProviderAdapter implements AdvertisementProviderInterface
{

	public function publicate(Advertisement $advertisement): AdvertisementResponse
	{
		$fbAdvertisement = new FbAdvertisement();
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("default title");
		}
		if (!$advertisement->getBody())
		{
			$advertisement->setBody('default message body');
		}
		$fbAdvertisement->setTitle($advertisement->getTitle())
			->setMessageText($advertisement->getBody());
		$result=(new FbPublicator())->publicate($fbAdvertisement);
		return (new AdvertisementResponse())->setTargeting($result->getTarget());
	}

	public function prepare(Advertisement $advertisement):Advertisement
	{
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle('default title');
		}
		return $advertisement;
	}

	public function check(Advertisement $advertisement):bool
	{
		if (!$advertisement->getTitle())
			return True;
		return False;
	}

	public function calculateDuration(Advertisement $advertisement):float
	{
		return $advertisement->getDuration()*100;
	}
}