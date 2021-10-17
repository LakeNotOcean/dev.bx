<?php

function readIntData(string $inputMessage, string $errorMessage,
	int $minValue = PHP_INT_MIN, int $maxValue = PHP_INT_MAX): int
{
	while (true)
	{
		echo $inputMessage . ">> ";
		$input = readline();
		$inputNumber = (int)$input;
		if (
			(!($inputNumber == 0) || $input == "0")
			&& $input >= $minValue
			&& $input <= $maxValue
		)
		{
			return $inputNumber;
		}
		echo $errorMessage . "\n";
	}
}