<?php

/** @var array $movies */
/** @var array $genres */


require_once "../data/genres.php";
require_once "../data/movies.php";
require_once "../lib/template-functions.php";
require_once "../lib/help-functions.php";

$currentActiveTitle = 'main';

if (isset($_GET['genre']))
{
	$genre = $genres[$_GET['genre']];
	if (!empty($genre))
	{
		$movies = getMoviesByGenre($movies, $genre);
		$currentActiveTitle = $_GET['genre'];
	}
}
elseif (isset($_GET['search']))
{
	$search = $_GET['search'];
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








