<?php

namespace Army;

use Army\Weapon\Bow;
use Army\Weapon\Knife;

abstract class AbstractWeaponForge
{
	abstract public function createBow():Bow;
	abstract public function createKnife():Knife;
}
