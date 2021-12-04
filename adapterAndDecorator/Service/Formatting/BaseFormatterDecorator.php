<?php

namespace Service\Formatting;

abstract class BaseFormatterDecorator implements Formatter
{
	protected $baseFormatter;

	public function __construct(Formatter $baseFormatter)
	{
		$this->baseFormatter = $baseFormatter;
	}
}