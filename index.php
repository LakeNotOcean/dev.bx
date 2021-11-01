<?php

/** @var array $menuItemsRef */
/** @var array $movies */
require_once "./homework-4/lib/template-functions.php";
require_once "./homework-4/data/menu.php";
require_once "./homework-4/data/movies.php";

$menuListLayout = renderTemplate("./homework-4/pages/menuList.php",
	['menuItemsRef' => $menuItemsRef]);

$searchBarLayout = renderTemplate("./homework-4/pages/searchBar.php");

$moviesListLayout = renderTemplate('./homework-4/pages/moviesList.php',
	['movies' => $movies]);



$page=renderLayout([
	'menuList' => $menuListLayout,
	'header' => $searchBarLayout,
	'content' => $moviesListLayout,
]);

echo $page;







