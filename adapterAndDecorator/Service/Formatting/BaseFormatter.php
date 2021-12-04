<?php

namespace Service\Formatting;

class BaseFormatter implements Formatter
{

	public function format(string $text): string
	{
		return $text;
	}
}