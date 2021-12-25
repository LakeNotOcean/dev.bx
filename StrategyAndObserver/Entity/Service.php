<?php

namespace Entity;

class Service
{
	public const TYPES = [
		"none"=>-1,
		"premium" => 0,
		"premium_lite" => 1,
	];

	public const deviceTypes = [
		"Web" => 0,
		"Android" => 1,
		"Ios"=>2,
		"Windows"=>3,
		"MacOS"=>4,
	];

	private $isLite;
	private $activatedAt;
	private $activatedUntil;
	private $pausedAd;
	private $canceledDate;

	private $type=-1;
	private $activatedDevices=[];

	/**
	 * @return mixed
	 */
	public function getActivatedAt()
	{
		return $this->activatedAt;
	}

	/**
	 * @param mixed $activatedAt
	 * @return Service
	 */
	public function setActivatedAt($activatedAt)
	{
		$this->activatedAt = $activatedAt;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getActivatedUntil()
	{
		return $this->activatedUntil;
	}

	/**
	 * @param mixed $activatedUntil
	 * @return Service
	 */
	public function setActivatedUntil($activatedUntil)
	{
		$this->activatedUntil = $activatedUntil;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPausedAd()
	{
		return $this->pausedAd;
	}

	/**
	 * @param mixed $pausedAd
	 * @return Service
	 */
	public function setPausedAd($pausedAd)
	{
		$this->pausedAd = $pausedAd;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCanceledDate()
	{
		return $this->canceledDate;
	}

	/**
	 * @param mixed $canceledDate
	 * @return Service
	 */
	public function setCanceledDate($canceledDate)
	{
		$this->canceledDate = $canceledDate;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIsLite()
	{
		return $this->isLite;
	}

	/**
	 * @param mixed $isLite
	 * @return Service
	 */
	public function setIsLite($isLite)
	{
		$this->isLite = $isLite;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 * @return Service
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
	/**
	 * @param mixed $deviceType
	 * @return Service
	 */
	public function activateDevice($deviceType): Service
	{
		$this->activatedDevices[]=$deviceType;
		return $this;
	}
	/**
	 * @return mixed
	 */
	public function getActivatedDevices()
	{
		return $this->activatedDevices;
	}
}