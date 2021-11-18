<?php

/** @var array $genres */

require_once "../lib/template-functions.php";
require_once "../onPageOpen.php";
require_once "../config/constants.php";

$menuLayout = renderMenuLayout(menuFavourites,$genres);
echo renderFullPageWithContent($menuLayout, "nothing");