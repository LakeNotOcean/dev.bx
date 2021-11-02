<?php


/** @var array $movies */
require_once "./homework-4/lib/template-functions.php";
require_once "./homework-4/data/menu.php";
require_once "./homework-4/data/movies.php";



$moviesListLayout = renderTemplate('./homework-4/pagesAndParts/moviesList.php',
	['movies' => $movies]);



$result=renderLayout(
	$moviesListLayout,
);

echo $result;








