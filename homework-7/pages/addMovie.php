<?php

/** @var array $genres */

require_once "../lib/template-functions.php";
require_once "../onPageOpen.php";

$menuLayout = renderMenuLayout("", $genres);
echo renderFullPageWithContent($menuLayout, "One more nothing");

