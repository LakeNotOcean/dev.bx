<?php

namespace Army\Barbarian;

use Army\AbstractWeaponForge;
use Army\Weapon\Bow;
use Army\Weapon\Knife;

class BarbarianWeaponForge extends AbstractWeaponForge
{
	public function createBow(): Bow
	{
		return new BarbarianBow();
	}
	public function createKnife(): Knife
	{
		return new BarbarianKnife();
	}
}