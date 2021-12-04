<?php

namespace Service\Formatting;

class HeadFormatterDecorator extends BaseFormatterDecorator
{

	public function format(string $text): string
	{
		return "<h1>Внимание</h1> ".$this->baseFormatter->format($text);
	}
}