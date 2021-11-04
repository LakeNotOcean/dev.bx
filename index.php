<?php


/** @var array $movies */
require_once "./homework-5/lib/template-functions.php";
require_once "./homework-5/data/menu.php";
require_once "./homework-5/data/movies.php";



$moviesListLayout = renderTemplate('./homework-5/pagesAndParts/moviesList.php',
	['movies' => $movies]);



$result=renderLayout(
	$moviesListLayout,
);

echo $result;








