<?php

/** @var mysqli $database */
/** @var array $movies */
/** @var array $genres */

require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";
require_once "../databaseFunctions/moviesDatabaseQueries.php";
require_once "../config/config.php";
require_once "../databaseFunctions/database.php";
require_once "../config/constants.php";

$currentActiveTitle='main';

if (isset($_GET[getGenreStr]))
{
	$genreName = $_GET[getGenreStr];

	if (!empty($genreName))
	{
		$genreId=array_search($genreName,$genres);
		if ($genreId=)
		$movies = getMoviesList($database, $genres, $genreId);
		$currentActiveTitle = $_GET[getGenreStr];
	}
}

elseif (isset($_GET[getSearchStr]))
{
	$search = $_GET[getSearchStr];
	$movies = searchMoviesByTitle($movies, $search);
}

$menuLayout = renderMenuLayout($currentActiveTitle);

if (!empty($movies))
{
	$content = renderTemplate(getLayoutPathName("moviesLayout.php"), [
		'movies' =>
			$movies,
	]);
}
else
{
	$content = "Нет подходящих фильмов";
}
echo renderFullPageWithContent($menuLayout, $content);








