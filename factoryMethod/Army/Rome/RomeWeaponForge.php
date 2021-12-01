<?php

namespace Army\Rome;

use Army\AbstractWeaponForge;
use Army\Weapon\Bow;
use Army\Weapon\Knife;

class RomeWeaponForge extends AbstractWeaponForge
{
	public function createKnife(): Knife
	{
		return new RomeKnife();
	}
	public function createBow(): Bow
	{
		return new RomeBow();
	}
}