<?php

namespace Service\Formatting;

class FooterFormatterDecorator extends BaseFormatterDecorator
{

	public function format(string $text): string
	{
		return $this->baseFormatter->format($text) . " <footer><p>Ждем Вас</p></footer>";
	}
}