<?php

use \Army\Archer;

spl_autoload_register(function ($class)
{
	include __DIR__ . '/'.str_replace("\\", "/", $class) . '.php';
});

$calculatePower = function ($sum, $warrior)
{
	$sum += $warrior->power();
	return $sum;
};


$build = new \Army\Builder\ArcherBuilder(new \Army\WarriorTemplate(),new \Army\Barbarian\BarbarianWeaponForge());

var_dump(\Army\Builder\Director::build($build));

$build->addLeftHandArmor()->getWarrior();