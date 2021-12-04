<?php

namespace Entity;

class Advertisement
{
	private $title;
	private $body;
	private $duration;


	public function getTitle(): string
	{
		return $this->title;
	}


	public function setTitle(string $title): Advertisement
	{
		$this->title = $title;
		return $this;
	}

	public function getBody(): string
	{
		return $this->body;
	}

	public function setBody(string $body): Advertisement
	{
		$this->body = $body;
		return $this;
	}

	public function getDuration(): int
	{
		return $this->duration;
	}


	public function setDuration(int $duration): Advertisement
	{
		$this->duration = $duration;
		return $this;
	}


}