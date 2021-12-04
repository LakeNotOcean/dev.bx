<?php

namespace Service;

use Adapter\VkAdvertisementProviderAdapter;
use Entity\Advertisement;
use Entity\AdvertisementResponse;

class VkProvider extends AbstractAdvertisementProvider
{
	public function publicate(Advertisement $advertisement): AdvertisementResponse
	{
		$advertisement->setBody($this->formatter->format($advertisement->getBody()));
		echo $advertisement->getBody();
		return (new VkAdvertisementProviderAdapter())->publicate($advertisement);
	}

	public function prepare(Advertisement $advertisement):Advertisement
	{
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("hello");
		}
		return $advertisement;
	}

	public function check(Advertisement $advertisement):bool
	{
		return True;
	}

	public function calculateDuration(Advertisement $advertisement):float
	{
		return $advertisement->getDuration();
	}
}