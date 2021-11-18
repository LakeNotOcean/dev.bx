<?php

/** @var mysqli $database */
/** @var array $genres */

require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";
require_once "../databaseFunctions/moviesDatabaseQueries.php";
require_once "../config/config.php";
require_once "../onPageOpen.php";
require_once "../config/constants.php";

$selectedMenuItem = menuMain;
$movies = [];

if (!empty($_GET[getGenreStr]))
{
	$genreCode = $_GET[getGenreStr];

	$idSearchResult = array_search($genreCode, array_column($genres, gCODE));
	$genreId = $idSearchResult !== false ? intval($idSearchResult) + 1 : 0;
	if ($genreId > 0)
	{
		$movies = getMoviesListOnGenres($database, $genres, $genreId);
	}
	$selectedMenuItem = $genreCode;
}
elseif (!empty($_GET[getSearchStr]))
{
	$searchStr = $_GET[getSearchStr];
	$movies = getMoviesByTitle($database, $genres, $searchStr);
}
else
{
	$movies = getMoviesListOnGenres($database, $genres);
}

$menuLayout = renderMenuLayout($selectedMenuItem, $genres);

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








