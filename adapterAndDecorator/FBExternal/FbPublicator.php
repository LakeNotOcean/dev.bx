<?php

namespace FbExternal;

class FbPublicator
{
	public function publicate(FbAdvertisement $advertisement):FbAdvertisementResult
	{
		return (new FbAdvertisementResult())->setTarget("response from FB");
	}
}