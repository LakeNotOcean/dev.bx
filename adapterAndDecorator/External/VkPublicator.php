<?php

namespace External;

class VkPublicator
{
	public function publicate(VkAdvertisement $advertisement): VkAdvertisementResult
	{
		//...
		return (new VkAdvertisementResult())->setTargetingName("response");
	}
}