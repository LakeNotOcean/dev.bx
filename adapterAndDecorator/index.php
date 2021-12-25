<?php

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/", $class) . '.php';
});

use \Service\Formatting;

$advertisement = (new \Entity\Advertisement())
	->setBody("test")
	->setTitle("test")
	->setDuration(10);

$formatter = new Formatting\FooterFormatterDecorator(new Formatting\HeadFormatterDecorator(new Formatting\BaseFormatter()));


$fbProvider=new \Service\FbProvider($formatter,new \Adapter\FbAdvertisementProviderAdapter());

var_dump($fbProvider->publicate($advertisement));
