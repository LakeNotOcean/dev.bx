<?php

/** @var array $menuItemsRef */
require_once "./homework-4/data/menu.php";

// var_dump(__FILE__);

function renderTemplate(string $path, array $templateData = []): string
{
	if (!file_exists($path))
	{
		return "";
	}

	extract($templateData, EXTR_OVERWRITE);
	ob_start();

	include $path;

	return ob_get_clean();
}


function renderLayout(string $content, array $templateData = []): string
{
	global $menuItemsRef;
	$menuListLayout = renderTemplate("./homework-4/layouts/menuLayout.php",
		['menuItemsRef' => $menuItemsRef]);

	$searchBarLayout = renderTemplate("./homework-4/layouts/searchBarLayout.php");


	$data = array_merge($templateData, [
		'content' => $content,
		'menuListLayout'=>$menuListLayout,
		'headerLayout'=>$searchBarLayout,
	]);
	$result = renderTemplate("./homework-4/layouts/layout.php", $data);
	return $result;
}