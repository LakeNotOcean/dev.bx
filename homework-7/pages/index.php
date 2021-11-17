<?php

/** @var mysqli $database */
/** @var array $movies */
/** @var array $genres */
/** @var bool $isGenreSelected */

require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";
require_once "../databaseFunctions/moviesDatabaseQueries.php";
require_once "../config/config.php";
require_once "../onFirstOpen.php";
require_once "../config/constants.php";

$currentActiveTitle = 'main';

if (isset($_GET[getGenreStr]))
{
	$genreCode = $_GET[getGenreStr];

	if (!empty($genreCode))
	{
		$genreId = intval(array_search($genreCode, array_column($genres, gCODE))) + 1;
		if ($genreId > 0)
		{
			$movies = getMoviesListOnGenres($database, $genres, $genreId);
			$isGenreSelected = true;
		}
		$currentActiveTitle = $genreCode;
	}
}
elseif (isset($_GET[getSearchStr]) && !empty($_GET[getSearchStr]))
{
	$searchStr = $_GET[getSearchStr];
	$movies = getMoviesByTitle($database, $searchStr);
}
elseif ($isGenreSelected === true)
{
	$movies = getMoviesList($database);
	$isGenreSelected = false;
}

$menuLayout = renderMenuLayout($currentActiveTitle, $genres);

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








