<?php

namespace Service;

use Entity\Advertisement;
use Entity\AdvertisementResponse;

interface AdvertisementProviderInterface
{
	public function publicate(Advertisement $advertisement):AdvertisementResponse;
	public function prepare(Advertisement $advertisement):Advertisement;
	public function check(Advertisement $advertisement):bool;
	public function calculateDuration(Advertisement $advertisement):float;
}