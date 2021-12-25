<?php

namespace FbExternal;


class FbAdvertisement
{
	private $title;
	private $messageText;

	public function getTitle(): string
	{
		return $this->title;
	}


	public function setTitle(string $title): FbAdvertisement
	{
		$this->title = $title;
		return $this;
	}

	public function getMessageText(): string
	{
		return $this->messageText;
	}

	public function setMessageText(string $messageText): FbAdvertisement
	{
		$this->messageText = $messageText;
		return $this;
	}
}