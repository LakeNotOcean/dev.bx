<?php

function printHelloMessage(string $message):void
{
	$indentation=str_repeat("#",20);
	$formatedMessage="$indentation\n"."$message\n".
		"Для выхода из приложения нажмите Ctrl+C или Ctrl+F2\n"."$indentation\n";
	echo $formatedMessage;
}

function printObjectGeneral($obj):void
{
	echo "${obj}\n";
}


