<?php

namespace FbExternal;

use External\VkAdvertisementResult;

class FbAdvertisementResult
{
	public $target;

	public function getTarget(): string
	{
		return $this->target;
	}

	public function setTarget(string $targetName): FbAdvertisementResult
	{
		$this->target = $targetName;
		return $this;
	}
}