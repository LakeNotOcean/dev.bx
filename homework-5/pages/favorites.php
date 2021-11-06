<?php


require_once "../lib/template-functions.php";

$menuLayout = renderMenuLayout("");
echo renderFullPageWithContent($menuLayout, "nothing");