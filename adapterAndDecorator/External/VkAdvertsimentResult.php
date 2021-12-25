<?php

namespace External;

class VkAdvertisementResult
{
	public $targetingName;

	/**
	 * @return string
	 */
	public function getTargetingName(): string
	{
		return $this->targetingName;
	}

	/**
	 * @param string $targetingName
	 * @return VkAdvertisementResult
	 */
	public function setTargetingName(string $targetingName): VkAdvertisementResult
	{
		$this->targetingName = $targetingName;
		return $this;
	}

}