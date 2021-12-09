<?php

namespace PurchaseStrategy;

use Entity\Service;

interface PurchaseStrategy
{
	public function purchase(): Service;
}