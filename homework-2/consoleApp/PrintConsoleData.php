<?php

$indentation = str_repeat("#", 20);

function printHelloMessage(string $message): void
{
	global $indentation;
	$formattedMessage = "$indentation\n" . "$message\n" .
		"Для выхода из приложения нажмите Ctrl+C или Ctrl+F2\n" . "$indentation\n";
	echo $formattedMessage;
}

function printLine($dataForPrint): void
{
	echo "${dataForPrint}\n";
}

function printEndMessage(string $message): void
{
	global $indentation;
	$formattedMessage = "$indentation\n" . "$message\n" . "$indentation\n";
	echo $formattedMessage;
}


