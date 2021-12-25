<?php

namespace Army\Builder;

use Army\AbstractWeaponForge;
use Army\Armor\Armor;
use Army\WarriorTemplate;
use Army\Weapon\Bow;
use Army\Weapon\Knife;
use Army\Weapon\Weapon;

class ArcherBuilder implements WarriorBuilder
{

	private $weaponForge;
	private $warriorTemplate;
	function __construct(WarriorTemplate $warriorTemplate,AbstractWeaponForge $weaponForge)
	{
		$this->weaponForge=$weaponForge;
		$this->warriorTemplate=$warriorTemplate;
	}

	public function addRightHandWeapon(?Weapon $weapon = null): WarriorBuilder
	{
		$this->warriorTemplate->set('rightHandWeapon', $weapon ?: $this->weaponForge->createBow());
		return $this;
	}

	public function addLeftHandWeapon(?Weapon $weapon = null): WarriorBuilder
	{
		$this->warriorTemplate->set('leftHandWeapon', $weapon ?: $this->weaponForge->createKnife());
		return $this;
	}

	public function addRightHandArmor(?Armor $armor = null): WarriorBuilder
	{
		$this->warriorTemplate->set('rightHandArmor',$armor);
		return $this;
	}

	public function addLeftHandArmor(?Armor $armor = null): WarriorBuilder
	{
		$this->warriorTemplate->set('leftHandArmor', $armor);
		return $this;
	}

	public function addHeadArmor(?Armor $armor = null): WarriorBuilder
	{
		$this->warriorTemplate->set('headArmor', $armor);
		return $this;
	}

	public function createWarriorTemplate(): WarriorBuilder
	{
		$this->warriorTemplate = new WarriorTemplate();
		return $this;
	}

	public function getWarrior(): WarriorTemplate
	{
		return $this->warriorTemplate;
	}
}